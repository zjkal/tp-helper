# TP-Helper
a Helper library for Thinkphp6

### 通过Composer导入类库
```
composer require zjkal/tp-helper
```

### 方法说明
1. 字符串可逆加密
    * 用法
    ```
   use al\helper\Encoder;
   
   //加密方法
   Encoder::encode('raw string');
   
   //解密方法
   Encoder::decode('encoded string');
    ```
    * 配置  
    可以配置加密和解密的秘钥,默认为ykmaiz,在config目录下的al.php(如果没有就新建一个)中增加以下代码:
    ```
    'encoder-key'=> 'ykmaiz'
    ```
2. 对数字ID进行追加长度的混淆类
    * 用法
    ```php
   use al\helper\Id;
   
   //给ID添加混淆后缀
   Id::encode('raw id');
   
   //验证混淆后缀,并还原ID
   Id::decode('encoded id');
    ```
   * 配置  
   可以配置追加的长度,默认为5,在config目录下的al.php(如果没有就新建一个)中增加以下代码:
   ```
   'id-length'=> 5
   ```
3. 时间助手类
   * 用法
   ```
   use al\helper\Time;
   
   //返回到今天晚上零点之前的秒数
   Time::secondEndToday();
   ```