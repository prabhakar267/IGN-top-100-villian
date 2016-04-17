# -*- coding: utf-8 -*-
# @Author: prabhakar
# @Date:   2016-04-16 21:03:43
# @Last Modified by:   Prabhakar Gupta
# @Last Modified time: 2016-04-18 01:55:06

import MySQLdb
import requests
from bs4 import BeautifulSoup
from DBdetails import *

conn = MySQLdb.connect(host=DB_HOST, user=DB_USER, passwd=DB_PASS, db=DB_NAME)
cur = conn.cursor()

def fetch_data(website_url):
	page_number = 100

	while(page_number >= 1):
		url = website_url + str(page_number) + ".html"
		source_code = requests.get(url)
		plain_text = source_code.text
		soup = BeautifulSoup(plain_text,'lxml')
		
		villian_title_info = str(soup.find('h1'))
		villian_title_info = villian_title_info.split('<')

		villian_name = str(villian_title_info[3].split('>')[1]).strip()
		villian_rank = int(villian_title_info[1].split('>')[1].split('.')[0])
		villian_link = str(villian_title_info[2].split('"')[1])
		villian_image = soup.find('img')['src']


		villian_info = ''
		for text in soup.findAll('p'):
			if text.string is None:
				continue

			villian_info += text.string + '\n'


		while True:
			try:
				query = "INSERT INTO `data_python` (`rank`,`name`,`description`,`image`) VALUES (%s,%s,%s,%s)"
				data = (villian_rank, villian_name, villian_info, villian_image)

				cur.execute(query, data)
				break

			except UnicodeEncodeError:
				query = "INSERT INTO `data_python` (`rank`,`name`,`image`) VALUES (%s,%s,%s)"
				data = (villian_rank, villian_name, villian_image)

				cur.execute(query, data)
				break			
			
			finally:
				conn.commit()


		print(str(villian_rank) + ' - ' + str(villian_name))

		page_number -= 1


IGN_url = "http://ca.ign.com/top/comic-book-villains/"
fetch_data(IGN_url)

cur.close()