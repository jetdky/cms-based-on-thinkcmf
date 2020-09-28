<?php
$a = "2020/11/fopijfoijdgf.jpg";
$b = substr($a, 0, strrpos($a, "/") + 1);
echo $b;
$thumbName =  str_replace("/", "s_", strrchr($a, "/"));
echo $thumbName;