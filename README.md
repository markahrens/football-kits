# Football Kits

Football Kits is a project to create a simple visual representation of
football kits through the years.

## Requirements

You will need to have PHP with [Composer](https://getcomposer.org/) installed.

## Building

To build the site, run the following command from the project root:

`php build.php`

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
		* Design - Style of the kit, see [below](#designs) for full list.
		* Color(s) - Array of colors for the kit. Order of colors depends on the design.
		* Sponsor (optional) - Sponsor name as displayed on kit.
		* Sponsor Color (optional) - Color of the sponsor text/logo.
		* Added Design (optional) - For more complex kit designs, you can include custom SVG.

## Designs

### Solid - `solid`

Single color kit. This should also be used for any added designs to set the background of the design.

### Crest Stripe - `crestStripe`

Solid background for the kit with a stripe vertically where the team crest is. First color is for the background, second is for the stripe.

### Left to Right Diagonal Stripe - `diagonalStripeLtoR`

Solid background with a stripe running from the left shoulder to the right waist. First color is for the background, second is for the stripe.

### Right to Left Diagonal Stripe - `diagonalStripeRtoL`

Solid background with a stripe running from the right shoulder to the left waist. First color is for the background, second is for the stripe.

### Center Vertical Stripe - `centerStripe`

Solid background with a stripe running vertically in the center of the kit. First color is for the background, second is for the stripe.

### Wide Center Vertical Stripe - `wideCenterStripe`

Solid background with a wide stripe running vertically in the center of the kit. First color is for the background, second is for the stripe.

### Narrow Stripes - `narrowStripes`

Striped pattern with thin vertical stripes. The first color is for the background and the second is for the narrow stripes.

### Wide Stripes - `wideStripes`

Equally spaced wide vertical stripe pattern. The two colors can be swapped as the stripe width is equal.

### Sponsor Hoop - `sponsorHoop`

Solid background for the kit with a stripe across the chest where the sponsor would be. First color is for the background, second is for the stripe.

