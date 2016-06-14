=== Woo Postal Code Shipping Calculator ===
Contributors: MatheusGimenez, brasadesign
Donate link: http://brasa.art.br
Tags: woocommerce, shipping, postcode
Requires at least: 4.1
Tested up to: 4.1
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Plugin that creates a Woo Shipping Method to calculate shipping rates based on postcodes/zipcodes, using JSON structure.

== Description ==

Are you having troubles to find a plugin that allows you to create a shipping calculator based on postcodes/zipcodes? You don't need to go crazy, you've found it! With this plugin you will be able to setup a calculator using JSON that will automatically calculate shipping rates based on customer's postcodes/zipcodes.

To begin with: Do you know JSON? (What the f* is this?) Please read about it here: http://json.org/example

After installing this plugin, you go to your Dashboard -> WooCommerce -> Settings -> Shipping. The plugin will create a new Shipping Method that will allow you, using JSON, to calculate shipping rates for any postcode/zipcode. The syntax to setup the plugin can be found below:

Syntax:

{ "postcode": "rate" }

Multiple:

{
"postcode": "rate",
"postcode2": "rate",
"postcode3": "rate",
"postcode4": "rate",
"postcode5": "rate",
"postcode6": "rate",
}

Working examples:

{ "EC1A 1AH": "50" }

Multiple:

{ "EC1A 1AH": "50", "WC1B": "50", }

You can also use "*" to generalize the postcodes/zipcodes:

{ "EC1A *":"15" }


== Installation ==

* Upload plugin files to your plugins folder, or install using WordPress built-in Add New Plugin installer;
* Activate the plugin;

== Frequently Asked Questions ==

= What is the plugin license? =

* This plugin is released under a GPL license.

= Work in United Kingdom? =

* Yes.

== Changelog ==

= 1.0 = first version


== License ==

This file is part of JSON postcode shipping.

JSON postcode shipping is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published
by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

JSON postcode shipping is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

Get a copy of the GNU General Public License in <http://www.gnu.org/licenses/>.
