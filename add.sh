# 替换argon/functions.php
# 需要把文件放到wordpress下执行
path=wp-content/themes/argon/functions.php
req="require_once '/usr/share/nginx/html/wordpress/wp-content/random-image/images_neibu.php';"
text1='if ($url == "--bing--"){'
text2='\tif(\$url == \"random\"){\n\t\t\$url = random_get_pic();\n\t\treturn \$url;\n\t}';
text3='elseif ($url == "--bing--"){';

sed -i '/function get_banner_background_url(){/i'"$req"'' $path
sed -i '/'"$text1"'/i\'"$text2"'' $path
sed -i 's/'"$text1"'/'"$text3"'/' $path
