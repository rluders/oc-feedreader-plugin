# Description

This plugin provides an extensive and simple component that allows you to get a list from any feed and place it into your website. It's excellent if you need to display your WordPress blog posts on your October CMS website.

# FAQ

## Does it support multiple feed components in one page
Yes. It does support. Just remember to rename the component alias.

## Can I merge two feeds?
Yes. You can! Just add all the feed URLs that you wanna merge into the `Feed URL` component property, separated by  `;`.

**Example:**
http://site1.com/feed;http://site2.com/feed

# Component Implementation

```php
[feedList]
...
==
{% component "feedList" %}
```

It's better if you just drag the component to your page an them configure it.

# Component Properties

- **Feed URL**, must be a valid URL address to the XML feed that you wanna read.
- **Expire cache** (in minutes), how much time the plugin will keep a cache from the feed.

# Overwrite the component
If you choose to overwrite the default partial, the feed item has this following attributes that can be used inside the for loop:

**Item id**<br>
*string*<br>
``{{ item.id }}``

**Item title**<br>
*string*<br>
``{{ item.title }}``

**Item url**<br>
*string*<br>
``{{ item.url }}``

**Item author**<br>
*string*<br>
``{{ item.author }}``

**Item date**<br>
*DateTime*<br>
``{{ item.date }}``

**Item published date**<br>
*DateTime*<br>
``{{ item.publishedDate }}``

**Item updated date**<br>
*DateTime*<br>
``{{ item.updatedDate }}``

**Item content**<br>
*string*<br>
``{{ item.content }}``

**Item enclosure url**<br>
*string*<br>
``{{ item.enclosureUrl }}``

**Item enclusure type**<br>
*string*<br>
``{{ item.enclosureType }}``

**Item language**<br>
*string*<br>
``{{ item.language }}``

**Item categories**<br>
*array*<br>
``{{ item.categories }}``

# License

GPLv3