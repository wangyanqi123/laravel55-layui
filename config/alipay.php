<?php
return [
    'pay' => [
        // APPID
        'app_id' => '2016080500169067',
        // 支付宝 支付成功后 主动通知商户服务器地址  注意 是post请求
        'notify_url' => 'http://www.golanggogo.com/redirect_uri ',
        // 支付宝 支付成功后 回调页面 get
        'return_url' => 'http://www.golanggogo.com/pay_success',
        // 公钥（注意是支付宝的公钥，不是商家应用公钥）
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAvPEcUahy6xsaKsqd1OLT9aljzGxqAsEz76wtFqDHGwpjGgyQLZw6vO2x+tgKO+tPaOZGeI/fFFslGsJKL5qxVfaRdiPi5MaapvKrteK6ONA9k/hdOZ+vmqCxBoiJVVRsCAOk3T4KpTsZIQgomFyS+EM+eHIg4Rbk7MLQZQ0AEvQyDMoEmiNAB5QZFFXDpJl6A6x9p1s5l9q0dNQuBzdYmmzDkaI7/oe6UWb47MBAe9+m4cs/23R25VpNx0yOs8Jv2DdmCQ3Sho/Zj3b3rr/hM7lEGUmxGQomsjJWblcyv6u9GV1P9S+sjefclnvM/3Cteyq1Dj/5BmjSiMQH6xUBwQIDAQAB',
        // 加密方式： **RSA2** 私钥 商家应用私钥
        'private_key' => 'MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCE+lbVwMfbyqQu7c02LLAcYzW5f59woJf63YD9zoMzkPQvStk4/nL1XnJSU5s3a5YViE9tojH9yWSI1Ve6xlidTQJkdflEnmR+BDFO6RrNH/vPayDidU/lm+EWkCTMk2G+3YT1Cx+9qGq6N09UZsBjp8KACRtaBGwTll5txkH6QcrM64c7rilK8pxWVrdkY8tvW/IfoY54GpkyESQhdxg9798ihUluUmJGZCX5LHAeiqpfhjpdOpI7QUStTip6D0ikrC+zdQTlzFJSp3OLJVKrKBdNxFhGpr/GgZgq06LLdF2y79t+U52qXLGoPGfRqXz4u/wYB+MrKjz8nhkkpvZhAgMBAAECggEALj+GvdbLa6TBj1TDX0kRgv36LGa3hAtGcEhjWWJefSu30U7d15WfU7kiV4GeZRr02s5KmZ2kd1h4r6JLXbkoDqU+5MOnCvdviehZYdFusdKi2FOw3zHftMKO+TLuqXvErgYK/NJ+mo6dd+BOpdMKrF4nJjKEob0R/Yn5k4I1Zhy+updr7cADKzRTaqHh6AQTXlNm3zGJZsMBkBsfCmX1oVQFiB+kgKPyJIq+iGOuCdIVFmhBz4qjHsoRd3RA3N7DAnKHJMRRYDN++IGVgXBYh87QTpyDBOUKIFk9XgR7r0+HY9f/owheLhzhtcooSKPYpSlGuY7p0gYXu/HdkCg15QKBgQD+JYwnE5yx650XAbxRqn+/KrQZx/iITMF0HKhV/8gDpXY6TOxKegy8uSmAEJu+ECveBbOzl2sIoQzNesh/lbADzWjvqdYaBi8mT/Ok6y3JgQ5DvCKulE0yHaIaJl2hd4n+BpUr05GkFNXrkWPlyiF0o2uSuOVpqcP8979OtCcTzwKBgQCF8paeG46WGXItOx2NkMLdnoKnwmlHTwxz0LiR3l+YPKwy0lPKn5TU0dUdQ6ljis2No8oOMYEzk0uiJAxAU3ehpQHApXmx0qG64B1CfSxhZFUa6B3AultzhQG05yjb9n1GLGxCFKu+0L0DRWEglkhS/TQnhejxSlIunBiPXIVuzwKBgQDAh9FVCRZ78vJeq4HunCuKtt8ZaNRu7Tbgr5UXEV6E5KRcJkobYbqkfeFikzJpGfchi1BHjT4Ym2kHgSzC+rMNLl+AsDjyHh05+PeqyD83l/0mczAS8WZJwQk8pjPoTpbLSlFXkj+S/fXRL6NuQWJ26hZkYI3rLiC7UzQqe2/fIQKBgFnEjz5ct31Ohl9bu92RA5dk0Kk/ODELAAxp+BgCEMzE9J6GqJMlyaerDIk1PEMy1bkz6IkEklMPRuPeBrvhdE5HeFo0S89pmuvToKhbnS+T/xkuMCpmej18CP3E4XQwyBoMUW0jz0ntOI8FoycksEm12YsXSlrS9Sq5gBgr6FyvAoGBAOxz0tRcpjho61D0GxWmc+uPPwjy/fpSmJqQ/r/dp9SMxiGrtgFr1JaxDp42DD6NwEINXRATL3Ypuegvuvxba5dssXrws8vTceCBW8NrXND/5OuPm1mixpefmsvmdmSCDtQrsrONoCUZL0aOmdp5t/OyrVe6uuuUy/HB4qPyDrlk',
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