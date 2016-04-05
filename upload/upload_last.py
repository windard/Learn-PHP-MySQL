# coding=utf-8
import requests
import urllib
# url = 'http://1.tablegather.sinaapp.com/upload.php'
allfile = [r'C:\Users\dell\Desktop\Document\财务处\预借发票申请表.xls']
filename = ['预借发票申请表.xls']
url = 'http://1.tablegather.sinaapp.com/upload.php'
# url = 'http://localhost/uploadfile/upload.php'
for i,item in enumerate(allfile):
	# print item
	filepath=unicode(item,'utf-8')  
	# filepath=unicode(r'C:\Users\dell\Desktop\list.txt','utf-8')  
	path = filepath.split('\\')
	baoweichu = unicode(r'保卫处','utf-8')
	caiwuchu = unicode(r'财务处','utf-8')
	gonghui = unicode(r'工会','utf-8')
	guojichu = unicode(r'国际处','utf-8')
	guozichu = unicode(r'国资处','utf-8')
	houqinchu = unicode(r'后勤处','utf-8')
	houqinjituan = unicode(r'后勤集团','utf-8')
	jiguandangwei = unicode(r'机关党委','utf-8')
	jiaowuchu = unicode(r'教务处','utf-8')
	kegongban = unicode(r'科工办','utf-8')
	kexueyanjiuyuan = unicode(r'科学研究院','utf-8')
	renshichu = unicode(r'人事处','utf-8')
	shiyanshi = unicode(r'实验室','utf-8')
	tongzhanbu = unicode(r'统战部','utf-8')
	tuanwei = unicode(r'团委','utf-8')
	xiaoyouwang = unicode(r'校友网','utf-8')
	xinxihua = unicode(r'信息化','utf-8')
	xuanchuanchu = unicode(r'宣传处','utf-8')
	xuegongchu = unicode(r'学工处','utf-8')
	# kemu = 'baoweichu'
	if path[5] == baoweichu:
		kemu = "baoweichu"
	elif path[5] == caiwuchu:
		kemu = "caiwuchu"
	elif path[5] == gonghui:
		kemu = "gonghui"
	elif path[5] == guojichu:
		kemu = "guojichu"	
	elif path[5] == guozichu:
		kemu = "guozichu"				
	elif path[5] == houqinchu:
		kemu = "houqinchu"				
	elif path[5] == houqinjituan:
		kemu = "houqinjituan"				
	elif path[5] == jiguandangwei:
		kemu = "jiguandangwei"				
	elif path[5] == jiaowuchu:
		kemu = "jiaowuchu"				
	elif path[5] == kegongban:
		kemu = "kegongban"				
	elif path[5] == kexueyanjiuyuan:
		kemu = "kexueyanjiuyuan"				
	elif path[5] == renshichu:
		kemu = "renshichu"				
	elif path[5] == shiyanshi:
		kemu = "shiyanshi"				
	elif path[5] == tongzhanbu:
		kemu = "tongzhanbu"				
	elif path[5] == tuanwei:
		kemu = "tuanwei"				
	elif path[5] == xiaoyouwang:
		kemu = "xiaoyouwang"				
	elif path[5] == xuanchuanchu:
		kemu = "xuanchuanchu"				
	elif path[5] == xuegongchu:
		kemu = "xuegongchu"		
	elif path[5] == xinxihua:
		kemu = "xinxihua"	
	files = {'file':(urllib.quote(filename[i]), open(filepath, 'rb'))}
	data  = {'submit':'true','kemu':kemu} 
	page = requests.post(url, data=data,files=files)
	code = page.status_code
	html = page.content
	if code == 200:
		print "Successful ~"
		print html
	else:
		print "Failed ~"


# filepath=unicode(r'C:\Users\dell\Desktop\Document\人事处\2011以前年度考核登记表.docx','utf-8')  
# path = filepath.split('\\')
# renshichu = unicode(r'人事处','utf-8')
# if path[-2] == renshichu:
# 	print "Successful"