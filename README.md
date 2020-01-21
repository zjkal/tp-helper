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
   $str = Encoder::encode('test string');
   
   //解密方法
   echo Encoder::decode($str);
    ```
    * 配置  
    可以配置加密和解密的秘钥,默认为ykmaiz,在config目录下的my.php(如果没有就新建一个)中增加以下代码:
    ```
   'tp-helper' => [
       'encode-key'=> 'ykmaiz'
    ]
    ```
2. 对数据自增主键进行追加长度的混淆
    * 用法
    ```php
   use al\helper\Id;
   
   //把数据自增主键转换为ID
   $id = Id::key2id($key);
   
   //把ID还原为数据自增主键
   echo Id::id2key($id);
    ```
   * 配置  
   可以配置追加的长度,默认为5,在config目录下的my.php(如果没有就新建一个)中增加以下代码:
   ```
   'tp-helper' => [
     'id-length'=> 5
   ]
   ```