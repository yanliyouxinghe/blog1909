<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016101900723516",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEogIBAAKCAQEAlbiWSGfKnRRGveadhgZ/FCFVFRXM16IrFCTz/TTFEQXlIIWWR+uuLLkRXRGWQSCd74U+8ysmTMrDI4f1xBs9kDz0KnsfjXtlXYW8nZClA0ADm12f6BaOKW5nQGWU+twybVSWA1BXtDwx24oU44UxwhvIL3PYJABzvM6FIa7iWkoS1FqGFtACpat+kvHEYXgr2VEXmmMe9bo5p6AG2pst3uIAirgJEMIs91FRUGbHrwIdgtbZ5FfSQZ4rt/Ci6t/yxUZza8x1rUy+T9Fg5Yo9rrma2qa1qo0ZGX+vz9dX+TUgqPDtBg5aZa5G5FtKgTpMoVc4qwjmy7kWvzYGEnzMmwIDAQABAoIBAH+e2wMW7b9dRDuk8wsGSJYpH3QcpAH+aof+Q7fGnmA3TSqelA30GABpNCLH1fLn0ZgUVSdD1Z7JivKjdttVePGU82+uiaO41huU3sTUQcP2cdyiPqa/ayhnwj1DGW2H+rf0zPZAKrIoSTtghRO3OkXCFq5UKZ3ugLkktJiUkL7yaovM4kIxzmxmA4/7aOzploQhS23E5/jvy4s645ePnWfvxywCVMJd8d7BqOJV6/uvkk0+kMSEF+LINu9h7ZZgB4XuXgMCadUbfNejTf0VfdzLNiJ24zFkSfWFIPqJ1kgADKOVf6fxY5Ulk0zHKQeOv5sG1Q3IgZsmyJgpCoUK5ikCgYEA3kj7ri2geNBIgts+ci0VbbFhEhjV7Qo8lCeUNQscUHfED5sdQIB0cGEeBND7fW7RTrF+eXI4TiZr+vJlHp1F3g2rGW3yxwNmFSd+gK97lA2qj4pU68Mv6tRefsgB4CPLB648CeDiBEETFX40op30RRO7DF6ho5d5rH/K/I31Gy8CgYEArG4LULtYYp5z2iZW2mBUtEbx0Lo96XSQLln3j39nYQStKp5dqUiyWh3HqdZC0b0AOjVLDz21H6aYTC/V2hkReRA+qKMbhsBGzgY257TiW59EQOjBnacLX9rmKjMMiwf0cc092Pg/1no0Ykx7RULyQz9mlVIQoDziW0WcZfQoGlUCgYATc6GKmXWMfPWLdfId/bH9WmNbOQ8nYhjxAhGnHqTIqeJfVzyVE2idGPKOi1cmn9bzIvclW4hv1k7ms+WDa1Hc36dUX1m6bqK1QTKBwll3GEcPrpRF2VvNGe52+7umSJuQvX+FgcdlhehMnjGu9VGV5ecdav6MGUpNfRVfSnDjgwKBgANm5GhCWfsQHz8FlJ8YWXN5FtpEYmZRu2p+seit3c9HNVdq6nQlkAdBIShTptvWe8OqO4HgeMtYERcntnNoHTUjQek31pow/vSfoMOviOu/16vkK7W9jvbkLbhVa4Dutj7sirTWKQRFQvVRhvkV2gvDm3WEufk/WkPsuqo0R/pFAoGASskvqhcFWtTjGbOtmjJ22k4A9l/8Zp0sudqz+vBi+qJGDRzoEKPuAc4TazBT7YtCcX6xnQzHHUYEumpNxL4uXqryasGLYV48x6trvbwBRJVbb4cPbnBUsg0ePI7urxj1c8I1QpND/YG/KvMFkPaaD+GJQ692yIaIt5Dh0ybdT3g=",
		
		//异步通知地址
		'notify_url' => "http://工程公网访问地址/alipay.trade.wap.pay-PHP-UTF-8/notify_url.php",
		
		//同步跳转
		'return_url' => "http://localhost/alipay/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAo60ZlI7w2R0EBjr0dskGti1K6+KHN5j7mVHu0zXnHq/fJDYvCuIXjLXrwhHoWjrwJz9mW46+yVGWJYJW0NCbzj1AJCIjDNk7HwIHxRDj3FxobEKiowZ0bdJcZF8+4HsYfJW0Pg8FqKmqT4mUpEL2nzWvw2DPFWwVJEMxh05+r83eFtQ8fvpCfiGMh6lw9RNcnRBQa3PIVrZgE72+hL1fzlW66S7fMt23x6ysPUaHB8LKBLBAtNI1KnpTzZe5KKIZOqvJF7fInoSG5HyjLAafVOAfOzp0idIEXh6C+CVuDb2jYmRcGWiTRPQgx+KGVyz2NGT8DgKEnsVNSzr7cTkeKQIDAQAB",
		
	
);