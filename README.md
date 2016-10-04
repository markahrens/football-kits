# Football Kits

Football Kits is a project to create a simple visual representation of
football kits through the years.

## Requirements

You will need to have PHP with [Composer](https://getcomposer.org/) installed.

## Building

To build the site, run the following command from the project root:

`php builder.php`

After building the site, the build folder will have the built site. This is helpful to test any new kits you have added.

## Data

Each club has a file in the `data` folder. The data for each club is as follows:

* ID - Unique identifier used for the URL for the club page.
* Country Code - Two letter country code, generates the club directory and the flag.
* Name - The name of the club.
* Seasons - Collection of information for each season
	* Year - Year for the season.
	* League - Shorthand code for the league the club is in that season.
	* Kits - Collection of the kits for that season
		* Type - Type of kit, such as Primary, Away, etc.
		* Color - Primary color of kit.
		* Sponsor (optional) - Sponsor name as displayed on kit.
		* Sponsor Color (optional) - Color of the sponsor text/logo.
		* Added Design (optional) - For more complex kit designs, you can include custom SVG.

