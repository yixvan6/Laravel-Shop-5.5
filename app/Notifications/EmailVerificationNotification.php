<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Str;

class EmailVerificationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // 生成随即字符串作为验证 token，并缓存
        $token = Str::random(16);
        \Cache::put('email_verification_'.$notifiable->email, $token, 30);
        $url = route('email_verification.verify', ['email' => $notifiable->email, 'token' => $token]);

        return (new MailMessage)
                    ->greeting($notifiable->name.' 您好：')
                    ->subject('请验证您的邮箱')
                    ->line('请点击下方的链接进行验证，有效期 30 分钟')
                    ->action('验证', $url);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [];
    }
}
