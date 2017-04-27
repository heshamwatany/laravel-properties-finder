# Property Finder Project Build With Laravel

A laravel property finder project for people to look and post properties for rent, shared rent (finding roomates), or lease takeovers. 
It implements cool APIs and libraries such as Algolia, dropzone.js, galleria.js, google maps, geolocation, and smarty streets, among others.
There is plenty of refactoring pending, plus testing, which will be taken care of soon.

## Algolia

### Filtering and Faceting

I used Algolia's filtering and faceting capabilities in order to allow the user to filter down their search results by any set of different 
attributes.

![alt text](https://cloud.githubusercontent.com/assets/23323398/25495802/322e5db2-2b44-11e7-9bd0-61774d63ca2b.png)

### Instant Search (Autocomplete)

I used a jQuery plugin I developed myself (I will make it available soon) in order to have the autocomplete suggestions functionality with Algolia 
to predict and suggest what the user might be looking for.

![alt text](https://cloud.githubusercontent.com/assets/23323398/25495798/32261d14-2b44-11e7-8f7f-ac62074fa0e9.png)

## Smartystreets & Google Maps

I used the Smartystreets JavaScript API in order to help users identify the address of the property they were wanting to upload or publish,
in addition, via ajax and leveraging google maps geolocation, I displayed the map associated with the address they had just entered.

![alt text](https://cloud.githubusercontent.com/assets/23323398/25495801/322de832-2b44-11e7-980d-2fb132e15b8b.png)

## Dropzone.js

I used dropzone.js library in order  to allow users to upload images associated with the  properties they wanted to publish.

![alt text](https://cloud.githubusercontent.com/assets/23323398/25495799/32290f88-2b44-11e7-9455-6e35f1c4c01f.png)

## Galleria

I used Galleria in order to provide a cool slide show functionality in both full-screen and default-screen mode in order to allow the user to see the images associated with
a selected property.

![alt text](https://cloud.githubusercontent.com/assets/23323398/25495800/322b3e02-2b44-11e7-8363-83a89387e62b.png)