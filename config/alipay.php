<?php
return [
    'pay' => [
        // APPID
        'app_id' => '2016080500169067',
        // 支付宝 支付成功后 主动通知商户服务器地址  注意 是post请求
        'notify_url' => 'http://www.wangyanqi.cc/redirect_uri',
        // 支付宝 支付成功后 回调页面 get
        'return_url' => 'http://www.wangyanqi.cc/alipaynotify',
        // 公钥（注意是支付宝的公钥，不是商家应用公钥）
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAvPEcUahy6xsaKsqd1OLT9aljzGxqAsEz76wtFqDHGwpjGgyQLZw6vO2x+tgKO+tPaOZGeI/fFFslGsJKL5qxVfaRdiPi5MaapvKrteK6ONA9k/hdOZ+vmqCxBoiJVVRsCAOk3T4KpTsZIQgomFyS+EM+eHIg4Rbk7MLQZQ0AEvQyDMoEmiNAB5QZFFXDpJl6A6x9p1s5l9q0dNQuBzdYmmzDkaI7/oe6UWb47MBAe9+m4cs/23R25VpNx0yOs8Jv2DdmCQ3Sho/Zj3b3rr/hM7lEGUmxGQomsjJWblcyv6u9GV1P9S+sjefclnvM/3Cteyq1Dj/5BmjSiMQH6xUBwQIDAQAB',
        // 加密方式： **RSA2** 私钥 商家应用私钥
        'private_key' => 'MIIEogIBAAKCAQEAgt+raqw2XvS/MV+U6/9ixhnu9LiilNWOnuQVDiFh8Q1x5zbiXxxrz/MAbPUEnpgXo/08PLusGjbzZg9Rm9HKm7z/Rz8fAY+OTYOkKh7xHfwXk8abEGzrjr4WPGRoWWiKBYlvX8bxXFWJdI/9UXS+EY5eCX3fnThgFkLvXhQcgiFiZxq2T77aa7dBvGLro1vsT1MuFAJhygbbqxQpx4CZmbVFUQ5z51HB8BEcls+wNuSSEX1JN4ir0m4UiQzddk3Uyp7PuIBEEODVlJzBQcYtI1bv5N3KhMMaVDkozAbmpOWClJYD3WNqtY38HTZY7uP5OZbWianiwjiQzIi51nKfvwIDAQABAoIBAHZK/6Di2h5IMMzK7UvHQht3c2KlxOashUYfONzV1bZRhcQM+t4nTVff+GGDslI7fRrQGXN32t6zDpwQep5SKUVNtpxKdJcvj9uGgotD/oMwyora+GwHV39lV6nsw9kUwbSxfgbfRmhENIM0Zy8KS4aI3XzM1qNAQrG8fKnXmdEQWu9s9M67F51VuUK3ZEjgItgxnGGVYepIUxxwOaP2lvVSdGf2Y8Q6UFMwtzmvdUpb9VVt9uy2KZZ6kO5g3lup4i70n1wqeIMHO4voJpFcK899++L0PQzJR7oh394PPyBTxYCJObuG0lbEWQgkO5Z+AyayJQECwTJkiSpsMnrcPHkCgYEAut3gJBWMUs/6UjcSzyeVw+m77kjCt4Na1Nyw9R3zm7O8rkQykDS6Hjcq00DwVhVfU2UBkhy8cCmv1y5N2QBJeA2kinL6M2CpvNxhskoJM+amhx+fwzy7p42EVVNtD7VRH8PYxJbBbEAgk+rQ4Htb6YrWo/p7kEcjB4tbpram4IsCgYEAs0q0OmwEeh1JLsUnSO4jwbjnye8Mz3lF2CwuvalJQCzUt6jOO/oh1Gc2SVwRFMLS8dIWt6aN7C6Fyw1WjmjEEfQExmyYodzLOw3pmjrWOnkycOHnG4y3LjzfzN9MrACbdhNWLftaHyP991gdRk8GLkScRNFG4qmYNx41T+hXkB0CgYBr/xcvQ5TZt4FASrwAJSyVEVyflkWSscOpCfLrduf3sKT3QkrGtPJrzA5gEUPVPHzfQZzqyNjPKgiKICS1qUjMrXXO3ixjzRXMJMIBvHAdIsxTg59dwpfhehRlC9YYIf5EkXeSBl67JUSuuCMH2cOA8dCi7HzFIZfJIG1TqHRBiQKBgA44aJ8RnjFJTVqmTH1eVfuxfMDpcuypw75nkrV8TdEHPT/r5Z+gMTq1jPq4kKpC4ZRIg4DBdxQ6hGYcgrb83EBISHCsgFamOoBOlC6laARvRG7rm/b1bDoAngeT1nL2AV6WHgm7m+RIaIZLuNawwd69ll9m8eZcaTRF8xiJZxiJAoGATMQrdeaaRjN/W7jz1V+EcYE+87PZCIIv5l6a0uyD3a5DPGQZH5HG32jt37SkP1pIVC02j+uz0TMVfwdFW4JI5pZ/Q3EbG1DBUKdPfXwlL/mDGKGtnM2O08g8DdK62fQLX8tMVWXkG8XJisoqRRAGvMGZ7siThxbnmkYR1xV/7Gg=',
        'log' => [ // optional
            'file' => '../storage/logs/alipay.log',
            'level' => 'info', // 建议生产环境等级调整为 info，开发环境为 debug
            'type' => 'single', // optional, 可选 daily.
            'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
        ],
        'http' => [
            'timeout' => 5.0,
            'connect_timeout' => 5.0,
            // 更多配置项请参考 [Guzzle](https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html)
        ],
        'mode' => 'dev', // optional,设置此参数，将进入沙箱模式
    ]
];