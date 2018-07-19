#!/usr/bin/env python
#coding: utf8

import requests
import json
import hashlib


def sign(*p):
    return hashlib.md5(u''.join(p).encode('utf8')).hexdigest().lower()


def pay():
    #如果是 web 应用，这里先获取用户充值参数，然后创建本地订单，然后把构造好的参数 post 到 bufpay
    #如果希望用 bufpay 的支付页面，这里可以返回一个构造好的表单给用户（如下），在这个表单里面 post 到 bufpay

    #<!DOCTYPE html>
    #<html>
    #    <head><title>redirect...</title></head>
    #    <body>
    #        <form id="post_data" action="{{bufpay_api}}" method="post">
    #            {% for k, v in data.items() %}
    #            <input type="hidden" name="{{k}}" value="{{v}}"/>
    #            {% endfor%}
    #        </form>
    #        <script>document.getElementById("post_data").submit();</script>
    #    </body>
    #</html>

    pay_data = {
        'name': u'内容订阅一年期',
        'pay_type': 'wechat',
        'price': '50.00',
        'order_id': '888',
        'order_uid': 'hi@sideidea.com',
        'notify_url': 'http://sideidea.com/bufpay_notify',
        'return_url': 'http://sideidea.com'
    }
    pay_data['sign'] = sign(
        pay_data['name'],
        pay_data['pay_type'],
        pay_data['price'],
        pay_data['order_id'],
        pay_data['order_uid'],
        pay_data['notify_url'],
        pay_data['return_url'],
        'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'  #app secret, 这里需要修改为自己的
    )
    resp = requests.post('https://bufpay.com/api/pay/2?format=json', data=pay_data)
    return json.loads(resp.text)


def query(aoid):
    resp = requests.get('https://bufpay.com/api/query/' + aoid)
    return json.loads(resp.text)


if __name__ == '__main__':
    resp = pay()
    print resp
    print query(resp['aoid'])
