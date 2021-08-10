# 随机图片API

Fork From [galnetwen](https://github.com/galnetwen)/**[Random-Image](https://github.com/galnetwen/Random-Image)**

简而言之就是做一个随机图片API调用，具体使用情况可以参考源链接，我这只做了一些小修改

- php8.0不支持count string，所以需要修改一下。

因为我用这个的目的主要是动态换主题的banner背景图，总共就没几张。然后这个随机图片API只能够使用服务器本地的图片，不走CDN，所以会有一点割裂感，就是加载比较慢，其他图片文章图片都加载出来了，而背景图还没加载出来，虽然就是在一秒左右的时间，但我还是感觉不爽，于是就稍微修改了一下，做了一个images-neibu.php，给内部的php使用。

因为我的主题是[argon-theme](https://github.com/solstice23/argon-theme)，可以支持修改banner背景图，只需要给一个url就行了。所以我把之前的程序修改一下，直接返回一个url就行了。

```php
return 'https://' . $_SERVER['HTTP_HOST'] . $img;
```

然后修改主题的functions.php文件（或执行add.sh），引入那个内部文件，然后如果在wordpress设置的url是random，那就随机获得图片的url，这个url就是普通的图片地址，因为是静态的，所以CDN会加速，大概就这样。

```php
require_once '/usr/share/nginx/html/wordpress/wp-content/random-image/images_neibu.php';
function get_banner_background_url(){
	$url = get_option("argon_banner_background_url");
	if ($url == "--bing--"){
		巴拉巴拉
	}
	elseif($url == "random"){
		$url = random_get_pic();
		return $url;
	}
	else{
		return $url;
	}
}
```

