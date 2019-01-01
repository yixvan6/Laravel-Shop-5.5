<?php

return [
    'alipay' => [
        'app_id'         => '2016092500592722',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAoELOVmpjdgRHMrtHab8AqZrnPPJhlEblQl6pXANX4iFFD8kIHFHI7arkTeSsYuTMN2BYTm2E87F9xV+hd7Qf5uCZo9lJeZR0ddXFkJWWupqJHtnC6GRvh0OIwUXIizH6l7se5ihcIYLeO07kErp7ZFimN3QXFljrnBlTYPEDOHy2ETyUBgwyzLHaYkV1prcN9pLOfx8BEyxJxkGSoFZsAbe6FOd1NBlv0vn/BeHLr1xAZeGPFSDPuP9K+0UjQjyWCO7HFd38wMsFvnR3EW2Wh2FTMwOWAPvkRCxVuLiTAtmmYSeNS8yOU11Zd3peeY5gBd3wlBIYOBpv0CpYe2O54QIDAQAB',
        'private_key'    => 'MIIEpAIBAAKCAQEAvGBvI88K++4XrLGl+G8gYFVZuM2czH6vW7xI/CLNAMNoBSewllOWw73+nX6HeVwCV73bvBAdqJsx/wn6zB+Zcr4EH/o+JYXlPV4ENvC1Fgkv2hUJsNnjutEt3CKRycb4rK6EwO28uEpcoMfoZs1znP7V+i/kylfrS/m/i0jiKLuB2Nk1Q8fpFt5i/x3Mx2oc2kek7AFt4i9Wx+2iWjePNWuN8DYWuk3vo+ZBl0pf+M3ZFQf4c9xIoXI4N9YIvf1Zgjd/ZjqioUT8HI7IZFonkoJHM1VVZavJjHhmaQLr8A1x2szctbUv04cNIeY894rk8qGVG7iXBl5iQ90G6ekKBQIDAQABAoIBAF4OvI+hqndeS53j2d4xBnZzR2hZ6efFfaONYNfcPIYcC40/YxG8TPQRotdavSQgh97topDFbzmnvA//GKXhRUogjIi2917e+zZoAiy4hYKqNaVribovIWE/XumirS6V1cbLIOgADJHsN1HkXystfIOwToEsds19lrQJ0NUoIBx7oAtuSbys1wFj5Qkg1UOA42g9GMfBKjSo72TUsxE1VJYn5dMCT2NJHfgvi2r6QVZ/HgDAAXh10MXRYelUsFEdoNcuxOFv3/o0zAHM/UezaraHm57C11rlVIUJ3cmSoocef4G6gD2KKaycbJoQbk0iVDusamNThBWEAhtTlRHsQQUCgYEA433Y51DS8Qt7dn14PbTGF30OjHvpviTX7rVtXiVDVHo8XmlP4o2hGwORW+CyQ812xV1GECSwgB1TeTL7sA5cnZFCxY801AzT2eOpf0sAIEX7yd02nsqHnwB338PmdBdLxFER4jAwfJfZJbV5HQNf/BJ2jAXlxhUttpnMfEbSI1MCgYEA0/u+Jlscbo6XQAz4zY3vD+yuha7L1yeMdp4VJsDIl8zudM9xcFSh3kMdGOOKkMbU1O3y8RtU/IkkM3peddZEbZPIwEDdgZU12vSlTHElgAERUdgXe9UBI2bAqIomJQwjsL5nezqvleHQHQZLJ0ec/D75EWVC74niKtIZPObACkcCgYASP4ELpQ8WqM4hhhUEFiEhtzVYjYQFbZ0ol8MLH0AUYa3AAQCYcrXunc2mKhMCn1Ocp0u8dcT2seOFQFKyH6TMOt+5SzB4pgLEYp+xB0oeTJ7S5XzBJgvU9EupVmSBAXFhcQNXOnhZNjED9ledvSyQ4sZBmyOATSiakiG2AlRO4wKBgQDAXaKgi+2xJhR7O0pMvpBCkzWMeqLgDDObMLlhAXEG0CFUPytiFGsPlzfAbjxARS6+S3A6++KTiKAhVtqBdH+EMKfsTvCztwO4PmoChGrTTiS5cK9e4Fy4E3ahezxCQlHhAehGG2tbSB/jNuLcMlBzV3IOJyYm2akz0pS0f3Gl4QKBgQCy45smrJo8pLqP5ba59m22VzLcMoRcX873drWLDcrFRAZaPNob5g1gzhfIN/tWACPFVjCO8MZ5QuNhB5Xr1WXjgU3njA949ylkTxwSDuHSDfInZ7an+E7nbaied89B7dMRdZywyZsoD47fBEWgnZ7TmTJ0WXR/x3dzclshRIYqjg==',
        'log'            => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id'      => '',
        'mch_id'      => '',
        'key'         => '',
        'cert_client' => '',
        'cert_key'    => '',
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];