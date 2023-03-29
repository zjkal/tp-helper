# 为了更方便大家使用,决定将时间助手函数独立为一个composer类库

# [https://github.com/zjkal/time-helper](https://github.com/zjkal/time-helper)

```bash
composer require zjkal/time-helper
```

### 请大家及时更换composer配置
- - -
分割线分割线分割线分割线分割线分割线分割线分割线分割线分割线分割线分割线分割线分割线分割线分割线
- - -









# tp-helper

这是一个适用于Thinkphp5和Thinkphp6的助手函数库，作者将长期维护并不断完善使用率比较高的助手函数。
使用过程中发现BUG或者希望添加其他助手函数，请直接提交Issues或者直接与我联系。

### 通过Composer导入类库

```bash
composer require zjkal/tp-helper
```

### 配置说明

凡是涉及到配置项的方法, 全部使用Thinkphp的助手函数config获取的,可以在config目录下新建helper.php配置文件,也可以在config.php中直接配置,例如:

```php
//config.php
return [
    'helper.name'=>'value',
];
```

或者

```php
//helper.php
return [
    'name'=>'value',
];
```

原则:确保使用config('helper.name')可以访问到

### 方法说明

1. 字符串可逆加密
    * 用法
    ```php
    use al\helper\Encoder;
    
    //加密方法
    Encoder::encode('raw string');
    
    //解密方法
    Encoder::decode('encoded string');
    ```
    * 配置  
      可以配置加密和解密的秘钥,不配置默认为ykmaiz,例如:
    ```php
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
    ```php
    'id-length'=> 5
    ```
3. 时间助手类
    * 用法(可以传入任何格式的日期或时间戳)
    ```php
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
   
    //如果只传入一个参数,则与当前时间比较,下面几个比较方法也支持只传入一个时间
    Time::diffDays(1586451741);
   
    //计算两个日期相差周数
    Time::diffWeeks('2022-4-10 23:01:11','Apr 11, 2020');
   
    //计算两个日期相差月数
    Time::diffMonth('2022-4-10 23:01:11','Apr 11, 2020');
   
    //计算两个日期相差年数
    Time::diffYears('2022-4-10 23:01:11','Apr 11, 2020');
   
   
    //返回指定时间3分钟前的时间戳
    Time::beforeMinute('2022-3-2 10:15:33', 3)
   
    //返回当前时间5分钟后的时间戳(请注意此用法为php8之后的用法)
    Time::afterMinute(minute=5)
   
    //返回指定时间1小时前的时间戳
    Time::beforeHour('Apr 11, 2020')
   
    //返回指定时间2小时后的时间戳
    Time::afterHour('Apr 11, 2020', 2)
   
    //返回指定时间15天前的时间戳
    Time::beforeDay('2022-7-11', 15)
   
    //返回指定时间15天后的时间戳
    Time::afterDay('2022-7-11', 15)
   
    //返回指定时间1星期前的时间戳
    Time::beforeWeek('2022-4-10 23:01:11')
   
    //返回指定时间10星期后的时间戳
    Time::afterWeek('2022-4-10 23:01:11', 10)
   
    //返回指定时间1个月前的时间戳
    Time::beforeMonth(1646360133)
   
    //返回指定时间5个月后的时间戳
    Time::afterMonth(1646360133, 5)
   
    //返回指定时间3年前的时间戳
    Time::beforeYear('2022-7-11', 3)
   
    //返回指定时间2年后的时间戳
    Time::afterYear('2022-7-11', 2)
   
   
    ```

特别说明: 所有时间的方法都可以传入任意格式的时间或者时间戳, 但是有一点请注意 m/d/y 或 d-m-y 格式的日期，如果分隔符是斜线（/），则使用美洲的 m/d/y 格式。如果分隔符是横杠（-）或者点（.），则使用欧洲的 d-m-y 格式。为了避免潜在的错误，您应该尽可能使用 YYYY-MM-DD 格式或其他格式.

### 开源协议

MIT
