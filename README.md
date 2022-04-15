# tp-helper

这是一个适用于Thinkphp5和Thinkphp6的助手函数库，作者将长期维护并不断完善使用率比较高的助手函数。 使用过程中发现BUG或者希望添加其他助手函数，请直接提交Issues或者直接与我联系。

### 通过Composer导入类库

```
composer require zjkal/tp-helper
```

### 配置说明

凡是涉及到配置项的方法, 全部使用Thinkphp的助手函数config获取的,可以在config目录下新建al.php配置文件,也可以在config.php中直接配置,例如:

```
//config.php
return [
    'al.name'=>'value',
];
```

或者

```
//al.php
return [
    'name'=>'value',
];
```

原则:确保使用config('al.name')可以访问到

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
      可以配置加密和解密的秘钥,不配置默认为ykmaiz,例如:
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
      可以配置追加的长度,不配置默认为5,例如:
    ```
    'id-length'=> 5
    ```
3. 时间助手类
    * 用法(可以传入任何格式的日期或时间戳)
    ```
    use al\helper\Time;
    
    //判断传入的参数是否为时间戳格式
    Time::is_timestamp(1646186290)
   
    //返回到今天晚上零点之前的秒数
    Time::secondEndToday();
   
    //返回1天的秒数
    Time::secondDay();
   
    //返回7天的秒数
    Time::secondDay(7);
   
    //返回4周的秒数
    Time::secondWeek(4);
   
    //返回友好的日期格式，比如刚刚、N秒前、昨天、N天前等等，一共3个参数，第一个参数传入字符串类型的时间或者时间戳都可以，
    //第二个参数为多少天以上直接显示为日期格式（默认365天），第三个参数为显示日期的格式，与PHP自带的date函数的格式化规则一致
    Time::friendly_date('2022-3-2 10:15:33');
    Time::friendly_date(1646186290, 365, 'Y-m-d');
    //也可以显示英文
    Time::friendly_date('2022-3-2 10:15:33',lang:'en');//php>8.0的用法
    Time::friendly_date('2022-3-2 10:15:33',365,'Y-m-d','en');//php<8.0需要写全参数
   
   //判断日期是否为今天
    Time::isToday('2020-4-10 23:01:11');
    
    //判断日期是否为本周
    Time::isThisWeek('2020-5-1');
    
    //判断日期是否为本月
    Time::isThisMonth(1586451741);
    
    //判断日期是否为今年
    Time::isThisYear('Apr 11, 2020');
   
    //计算两个日期相差天数
    Time::diffDays('2022-4-10 23:01:11','Apr 11, 2020');
    //如果只传入一个参数,则与当前时间比较
    Time::diffDays(1586451741);
   
    ```

### 开源协议

MIT