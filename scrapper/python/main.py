# -*- coding: utf-8 -*-
# @Author: prabhakar
# @Date:   2016-04-16 21:03:43
# @Last Modified by:   prabhakar
# @Last Modified time: 2016-04-18 00:27:30

import requests
from bs4 import BeautifulSoup


def aloo_gobhi():
	page_number = 100

	while(page_number >= 1):
		url = "http://ca.ign.com/top/comic-book-villains/" + str(page_number) + ".html"
		source_code = requests.get(url)
		plain_text = source_code.text
		soup = BeautifulSoup(plain_text,'lxml')

		villian_title_info = str(soup.find('h1'))

		villian_title_info = villian_title_info.split('<')

		villian_name = str(villian_title_info[3].split('>')[1]).strip()
		villian_rank = int(villian_title_info[1].split('>')[1].split('.')[0])
		villian_link = str(villian_title_info[2].split('"')[1])
		villian_image = soup.find('img')['src']

		# villian_info = ''

		# for text in soup.findAll('p'):
			# villian_info += text.string + '\n'

	
		# print(villian_image)
		# print(villian_rank)
		# print(villian_link)
		print(villian_rank, ' - ', villian_name)
		# print(villian_info)

		page_number -= 1
		# break


aloo_gobhi()