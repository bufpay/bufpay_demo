![BufPay 个人即时到账支付平台](https://upload-images.jianshu.io/upload_images/626292-5a767f3f35f91bd4.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

## 前言
作为独立开发者，一般只有一个人独立奋战，做出了产品需要收款是非常麻烦的，接入支付宝微信支付都需要公司公户，而注册公司、开公户等一系列操作非常麻烦，成本也很高一年也要 1w 左右。市面上有些聚合支付，手续费很高并且不安全也不靠谱。

基于我们自己的需求，我们做了 [BufPay.com 收款平台](https://bufpay.com)，**不需要营业执照、不用签约，真正个人开发者可用**。

## BufPay 的原理以及其特点
BufPay 原理是通过在 Android 手机上安装 BufPay App 检测微信和支付宝的二维码到账通知，进行订单回调。

所以要用 BufPay 你需要一个闲置的 Android 手机，一般大家家里都有吧，BufPay 现在自己用的就是一个几年前的红米手机。

## BufPay 的订单付款流程
- 产品用户在产品点击付费以后，开发者组织好参数调用 BufPay 的请求支付接口。
- BufPay 收到开发者支付请求后会 调度分配开发者的支付宝/微信 收款二维码显示到支付页面，给用户扫描支付。
- 用户支付后，开发者安装 BufPay App 的 Android 手机（已经登陆开发者收款支付宝、微信App）会收到到账通知，BufPay App 会检测到这个通知，并且回调通知。
- 最终 BufPay 服务器会回调开发者的服务器，告诉开发者订单已经支付，开发者根据自己的逻辑为客户开通服务。

## BufPay 支付具体接入步骤
- [注册 BufPay 账号](https://bufpay.com/main)，充值开通套餐（也可以等产品上线再充值）
- 用闲置 Android 手机 [下载](https://bufpay.com/htdocs/bufpay.apk) 安装 BufPay  App 并且 [根据教程配置手机](https://bufpay.com/page.html)
- [配置收款码](https://bufpay.com/page.html#conf)
- [支付 api 对接](https://bufpay.com/page.html#api)
  * *请求支付接口*
  * *订单查询接口*
  * *通知回调接口*

## Demo
- [Python Demo](https://bufpay.com/htdocs/bufpay_api_demo.py.zip)
- [PHP Demo](https://bufpay.com/htdocs/bufpay_api_demo.php.zip)
- 欢迎为 BufPay 增加其他语言的 Demo

## 在线体验支付流程
[登陆 BufPay 后台可以体验 BufPay 支付流程](https://bufpay.com/main)

BufPay 就是用自身提供的支付服务来充值，有点像开发 Git 时候 Git 自身管理自身 ```^_^``` 

有问题可以联系 BufPay 客服，微信 bufpay_com 邮箱 i@bufpay.com
