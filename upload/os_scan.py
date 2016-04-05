#coding=utf8
import os
import re
import requests

def showall(path,leavel=0,filenum=0,show=True):
	newnum = filenum
	currentpath = path;
	dirandfile = os.listdir(path)
	for item in dirandfile:
		newpath = os.path.join(currentpath,item)
		if os.path.isdir(newpath):
			num = showall(newpath,leavel+1,newnum,show)
			newnum = num
		else:
			tab_stop = ""	
			if show:		
				for tab in range(leavel):
					tab_stop = tab_stop + " "
			# FILE = open('list.txt','a')
			# FILE.write(newpath)
			# FILE.close()
			(namefirst,namelast) = os.path.split(newpath)
			if not namelast == '.DS_Store':
				try:
					print newpath
					FILE2 = open('list.txt','a')
					FILE2.write(newpath+'\n')
					FILE2.close()
				except Exception, e:
					print e + "ERROR"
				# print newpath
				# url = 'http://localhost/uploadfile/upload.php'
				# filepath=unicode(newpath,'utf-8')  
				# print filepath
				# path = filepath.split('\\')
				# path = newpath.split('\\')
				# if path[5] == unicode(r'保卫处','gbk'):
				# 	print path[5]
				# else:
				# 	print "NONE"
				# print path[5]
				# baoweichu = unicode(r'保卫处','utf-8')
				# renshichu = unicode(r'人事处','utf-8')
				# if path[-2] == renshichu:
				# 	kemu = "renshichu"
				# elif path[-2] == baoweichu:
				# 	kumu = 'baoweichu'
				# files = {'file':(urllib.quote('2011以前年度考核登记表.docx'), open(filepath, 'rb'))}
				# data  = {'submit':'true','kemu':kemu} 
				# page = requests.post(url, data=data,files=files)
				# code = page.status_code
				# html = page.content
				# if code == 200:
				# 	print "Successful ~"
				# 	print html
				# else:
				# 	print "Failed ~"			

				# files = {'file': open(newpath, 'rb'),}
				# data  = {'submit':'true'}
				# page = requests.post(url, data=data,files=files)
				# code = page.status_code
				# # html = page.content
				# if code == 200:
				# 	newnum = newnum + 1
				# 	print "Successful ~" + str(newnum)
				# 	# print html
				# else:
				# 	print "Failed ~"
	return newnum

if __name__ == '__main__':
	# num = showall(r'C:\Users\dell\Desktop\Document\人事处')
	num = showall('C:\\Users\\dell\\Desktop\\Document')
	# print "File Number : " + str(num)
