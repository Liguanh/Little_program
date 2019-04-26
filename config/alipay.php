<?php

//支付宝的支付信息
return [

	    'app_id' => '2016092100560499',//你创建应用的APPID
        'notify_url' => env('APP_URL').'/api/notify/url',//test.laravel_web.com',//异步回调地址
        'return_url' => env('APP_URL').'/api/return/url',//同步回调地址
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAv+IWt340Q/SnCHXUCWwbOtvbl6pT+nfm5hdwkSuPZ+UG42QrZOIsHvBtGv469q0my99NcuVGfYjve54frJVO4TOAdAyVsD9djXGWZJ6ENJ+Gd+N0npIRAML8MJkca6AbnZWBBPhXKeeYnw9qkMzu3i8UyhJ/p3tZlmqpfbWQQ+a0P3uPwYhR3DHkvrugrwZwVOQ6Kx8QQ7iWPVdHf/AhXYJbb2rgq820k6G9ftfWeH6efDhqPg4hSl4OqX/kC6wT0y/siyuDun5C4cduh1+gDn3NTKLREfoydAm6bF8M1gaEj3P/TbQVKXaaLhEu5/l4/U5VCB2ILz/QBcakA/zBzQIDAQAB',//是支付宝公钥，不是应用公钥,  公钥要写成一行,不要换行
        // 加密方式： **RSA2**
        'private_key' => 'MIIEpAIBAAKCAQEAu0Sep5WxOiA6psmBxEzeLP4dcezmDevL3H80FMQxCQWeY1Lk5KIkAWGS1oBiLsahnb/zgGtdT2kwUMflmB83uAyQYi1p1NPiGsyZqtPX+dbbAgXd0Qr+HNenpjznd93P8u+q2tSQBTxog5xVGsmQ3P1M+IVXCP/lkWb4Yd0T6177iP1AgU/JqN5E4GiXQybTmSk9wht2KkHO6c+8NQiYAQOlKSFUiA11evWVGnyWpcRoZX8KADrzluKd/ZXqbzSxaOWRxFRovEP4Q1d4PjxfdrQSV7D0w0CGJLzEBjJL92cuNOeqy9L0dBywvFrhRu27CNvW6Bwp+WZpSReHHTUZZQIDAQABAoIBAQC1MLWZTFrH9LsK+VlXR1CIk+6FdkM5IPaEh4cquJEBO7B+RYw2MzNHKtNaO6nDvGhPK5Q8oqUL2qjm4CKjR0EwEOf6Nhp50/CnIWNlR8dmcp5AnNB8HHi2C2qoi7Eh5zn2wjG7vYMDrekpvi8R1gkV6Pd6VflaOc4zG0Aj4DYPupVHgm7X9WGUUnvU70E3lKJ5bp5on6PPHEYgS6yKsguU88nUBY51/Y76d/rPl3gMOTzt+euP/7CLAtK+1C7EKmfYdxuyXC1XTDNOG/nW5kLpBZDt2qzesddpG5P6mtmTMB0oc3kjXHVgbPTYiQ8/mZUG6AqiM2UKUOjtht8xCtIZAoGBAN1cQJYsXueTyDst1ME+AwuJm67M5yBvc+rrL10FOcGTQC8jnD42hQiZXguiEbzkMBNFscne9/4VB/UbuqaFBqtUTJUEGAo1M2I28kx0lJ8XWHJUZ80pazN8Rg1BppMZVsoOMlHoBtPdwObcr0iDHLHDZCJO/Q9mw5FjDPCjVI7DAoGBANiSnxI1NR8/Vt/+1g3Jbg7ZXGsFhc3f0TAkcJmetT2TXmPhCsP+TTIGy4oNsDg0P1QJj7Nw96NztdVLBbTHH7lQMwGrn054O+D6WgtwICJNWZk7jt/g1DVLqxaigjnS+JQL5hHtplojaugnp37sjoprhKJt/u4j7X6cFqHH2AS3AoGBAIyl9h+1F6QawSng6ALUzQiCqdm6NczlJAkK4DBBhr4ZOrn47WiWKZcaI6hOlOipMGa+bMWwl2/omwLBWKo/ccpgqLwyOrgZr4ljEjdEB77CDZ+vQ7kW7RdsifIYWaezfPKrbIugWt45Uz0c0X7IV+4XEUO/XolvqSlyfyFTFgITAoGAObRnefx/WQIRbcGC202Oa5pyy3k/O6mlHUS4U9Y7yFpZzhcKPUqm2uuAlBotl+wj64pYpaE1+nE8Q8ankJF13HSIAqvt2ISkv780+tM3XKxrcS6zVOec4050GaXXOP0Dir7Y4HIH3wCM3aqjMGhrWmpnfrf8MwuTniaMyTJsVmUCgYBHW0CIHMDNgeT7sWfpsuo8aJjdy82MOhcJZZoFbPQdEWhrN7aAwm8+aNaF38UA8+ehaHwB8PyBz/WuYt4XZlg767WsMBmiVVodGhzpYsToz8G+er5H95uXQ+Grl+xwjWEA58caRJFrMmMHLIF2I3FctRisErq9WnZDqgFEeZlQnA==',//密钥,密钥要写成一行,不要换行
        'log' => [ // optional
            'file' => storage_path('logs/alipay.log'),
            'level' => 'info', // 建议生产环境等级调整为 info，开发环境为 debug
            'type' => 'daily', // optional, 可选 daily.
            'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
        ],
        'http' => [ // optional
            'timeout' => 5.0,
            'connect_timeout' => 5.0,
            // 更多配置项请参考 [Guzzle](https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html)
        ],
        'mode' => 'dev', // optional,设置此参数，将进入沙箱模式
];