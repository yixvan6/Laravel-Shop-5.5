<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use App\Exceptions\InvalidRequestException;
use App\Http\Requests\Admin\HandleRefundRequest;

class OrdersController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('订单列表')
            ->body($this->grid());
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order);

        $grid->no('订单流水号');
        // 关联关系的字段，用 column
        $grid->column('user.name', '买家');
        $grid->total_amount('总金额')->sortable();
        $grid->paid_at('支付于')->sortable();
        $grid->payment_method('支付方式');
        $grid->ship_status('物流')->display(function ($value) {
            return Order::$shipStatusMap[$value];
        });
        $grid->refund_status('退款状态')->display(function ($value) {
            return Order::$refundStatusMap[$value];
        });
        $grid->closed('订单是否关闭')->display(function ($value) {
            return $value ? '是' : '否';
        });
        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
        });
        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });

        return $grid;
    }

    public function show(Order $order, Content $content)
    {
        return $content->header('查看订单')
                        ->body(view('admin.orders.show', ['order' => $order]));
    }

    public function ship(Request $request, Order $order)
    {
        if (! $order->paid_at) {
            throw new InvalidRequestException('订单未支付');
        }
        if ($order->ship_status !== Order::SHIP_STATUS_PENDING) {
            throw new InvalidRequestException('订单已发货');
        }

        $data = $this->validate($request, [
            'express_company' => 'required',
            'express_no' => 'required',
        ], [], [
            'express_company' => '物流公司',
            'express_no' => '物流单号',
        ]);

        // 更新订单物流状态
        $order->update([
            'ship_status' => Order::SHIP_STATUS_DELIVERED,
            'ship_data' => $data,
        ]);

        return redirect()->back();
    }

    public function handleRefund(HandleRefundRequest $request, Order $order)
    {
        if ($order->refund_status !== Order::REFUND_STATUS_APPLIED) {
            throw new InvalidRequestException('订单状态错误');
        }
        if ($request->agree) {
            // 同意退款
        } else {
            $extra = $order->extra ?: [];
            $extra['refund_disagree_reason'] = $request->reason;

            $order->update([
                'refund_status' => Order::REFUND_STATUS_PENDING,
                'extra' => $extra,
            ]);
        }

        return $order;
    }
}