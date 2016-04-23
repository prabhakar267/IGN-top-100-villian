# IGN Top 100 Villians :hocho:

Simple scripts written in both PHP and Python to scrape the data from [IGN Website](http://ca.ign.com/top/comic-book-villains/) to scrape a list of Top 100 Comic Book Villains of All Time :hocho: (because villians are way more cool than heroes) and save in a MySQL database.
Then display it in a list one-page format which was not present on IGN original website.

I basically built this scraper so that I could read about all the villians on a single page and I don't need to click on NEXT for every other villian (Yeah, I am lazy :sleepy:).

## Instructions to Run Scrapper
+ Import MySQL dump file in your database
+ Add database and user credentials in respective files ([connection.inc.php](/scrapper/php/inc/connection.inc.php) for PHP and [DBdetails.py](/scrapper/python/DBdetails.py) for Python)
+ Run following instruction in your terminal

For PHP
```php
  php /scrapper/php/fetch_data.php
```

For Python
```python
  python /scrapper/python/main.py
```


## Screenshots
**Top Frame**
![Alt](/screenshots/Screenshot from 2015-12-02 18:41:49.png?raw=true)

**Bottom Frame**
![Alt](/screenshots/Screenshot from 2015-12-02 18:41:58.png?raw=true)
