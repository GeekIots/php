# 极客物联网API

blog/answer.php
发布回复到服务器

blog/new.php
发布新帖到服务器

blog/list.php
获取帖子列表

## device

### 用户开关、传感器等相关设备API

####  1、获取开关列表
```
https://www.geek-iot.com/api/device/device.php?device=switch&type=getlist&userid=1509639203636

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

####  2、添加开关
https://www.geek-iot.com/api/device/add.switch.php
```
userid:用户ID
name:开关名称
opencmd:开启指令
closecmd:关闭指令
pic:设备图片

返回结果：
success
{
    "resault": "success"
}
fail
{
    "resault": "fail",
    "msg":"error"
}
```

####  3、添加传感器
https://www.geek-iot.com/api/device/add.sensor.php
```
userid:用户ID
name:传感器名称
type:传感器分类
pic:设备图片

返回结果：
success
{
    "resault": "success"
}
fail
{
    "resault": "fail",
    "msg":"error"
}
```

## info
### 设置或获取网站的动态页面信息
#### 1、获取信息
https://www.geek-iot.com/api/info.php?type=get&name=geekiot_about

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
https://www.geek-iot.com/api/info.php?type=set&id=1&filed=content_md
说明：content_md代表的是字段名称，字段内容是通过post方式传送的
```
{
    "status": "success"
}
```

## blog
### 社区
#### 1、发布新帖
https://www.geek-iot.com/api/blog/new.php
#### 需要传递的参数
|    参数名 |    关键字    |    重要性    |
| --------  |    :----:    |    :----:    |
|    标题   |    title     |     必须     |
|    内容   |    contents  |     必须     |
|    分类   |    classify  |     必须     |
|    昵称   |    nickname  |     必须     |
```
{
    "status": "success"
}
```

```
{
    "status": "fail",
    "msg": "错误信息！"
}
```
#### 2、回复
https://www.geek-iot.com/api/blog/answer.php
#### 需要传递的参数
|    参数名 |    关键字    |    重要性    |
| --------  |    :----:    |    :----:    |
|    内容   |    contents  |     必须     |
|   原帖id  |    toid      |     必须     |
|    昵称   |    nickname  |     必须     |
```
{
    "status": "success"
}
```
```
{
    "status": "fail",
    "msg": "错误信息！"
}
```
## user
### 用户
#### 1、注册 register
https://www.geek-iot.com/api/user/register.php
#### 需要传递的参数
|    参数名 |    关键字    |    重要性    |
| --------  |    :----:    |    :----:    |
|    邮箱   |    email     |     必须     |
|    昵称   |    nickname  |     必须     |
|    密码   |    password  |     必须     |

```
{
    "status": "success"
}
```
```
{
    "status": "fail",
    "msg": "错误信息！"
}
```

#### 2、登录 login
https://www.geek-iot.com/api/user/login.php
#### 需要传递的参数
|    参数名 |    关键字    |    重要性    |
| --------  |    :----:    |    :----:    |
|    邮箱   |    email     |     必须     |
|    昵称   |    nickname  |     必须     |
|    密码   |    password  |     必须     |

```
{
    "status": "success"
}
```
```
{
    "status": "fail",
    "msg": "错误信息！"
}
```

