#!/bin/sh

# 需要安装 ksnapshot, gnome-screenshot

if  [ "$1" = "-d" ]
then
	sleep 3

	# 可以支持直接用鼠标截取菜单
	ksnapshot --region
else
	# 不知道为什么 不加延时鼠标选择窗口就出不来
	sleep 0.3

	# 这个程序如果在鼠标抓图模式下 如果用户点击菜单它就会放弃鼠标先取需是直接截全屏
	gnome-screenshot -a
fi

exit 0
