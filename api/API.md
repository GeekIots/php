# 极客物联网API
## 一、device

### 用户开关、传感器等相关设备API

####  1、获取开关列表
```
https://www.smtvoice.com/api/device.php?device=switch&type=getlist&userid=test

返回结果：
{
    "resault": "success",
    "num": 2,
    "list": [
        {
            "id": "12",
            "name": "客厅灯",
            "state": "close",
            "pic": "",
            "opencmd": "open",
            "closecmd": "close",
            "heat": "0",
            "icon": "img/3.png",
            "wid": 1
        },
        {
            "id": "13",
            "name": "工作室",
            "state": "close",
            "pic": "",
            "opencmd": "open",
            "closecmd": "close",
            "heat": "0",
            "icon": "img/3.png",
            "wid": 2
        }
    ]
}
```

## 二、info
### 设置或获取网站的动态页面信息
#### 1、获取信息
https://www.smtvoice.com/api/info.php?type=get&name=geekiot_about

```
{
    "status": "success",
    "num": 1,
    "list": [
        {
            "id": "7",
            "name": "geekiot_about",
            "des": "这是关于页面",
            "content_md": "# 这是关于页面\n<font face=\"STCAIYUN\" size=15 color=blue>这是关于页面</font>",
            "content_html": "<h1 id=\"-\">这是关于页面</h1>\n<p><font face=\"STCAIYUN\" size=\"15\" color=\"blue\">这是关于页面</font></p>\n",
            "datatime": "2017-08-27 22:07:53"
        }
    ]
}
```
#### 2、设置信息
https://www.smtvoice.com/api/info.php?type=set&id=1&filed=content_md
说明：content_md代表的是字段名称，字段内容是通过post方式传送的
```
{
    "status": "success"
}
```


