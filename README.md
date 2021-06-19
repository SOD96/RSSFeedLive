
## About Tech Test

Create a single application which connects to an RSS feed, pulls that feed into a database and outputs them into
a suitable UI.

A JavaScript snippet should also be created which will listen for a click on the feed only when the alt key is depressed
to follow the feed URL and view the article online

Clicking anywhere else should hide the button again

## Plan

- Use laravel sail, high compatibility between machines.
- Find an RSS feed (Twitter?, already using blog posts on portfolio?)
- Use BBC News feed, good chances with this.
- Create APIs for subscribing to new feeds / pulling content from feeds
- Pulled content should be stored in DB, perhaps we setup a laravel job to pull these every minute or so?

## Future Plan
- Protect APIs against potential attacks (Subscribing to feeds we don't want)
- Validation on API routes should display better error messages
- Split API Controller into two seperate controllers for Feed / Articles for better segregation
- Find a way to gather RSS images better, having to use random images at the moment
- Add a time check to see when the last feed was checked. Stops us requesting a new feed every time

## Findings
- Twitter seems to have disabled RSS feeds a while ago, only services out there now that provide it (nitter). Shame.

## Requirements
This uses Laravel Sail to deploy, you shouldn't need to do anything more than the below commands.
More on Laravel Sail available: https://laravel.com/docs/8.x/sail#installation

## Launching Application

Run in terminal: 
`./vendor/bin/sail up`

Run database migrations
`./vendor/bin/sail artisan migrate`

If you don't want to use the API via postman, you can seed the database via:
`./vendor/bin/sail artisan db:seed`

Can manually run the RSS get articles process using the command, however going to the main page will refresh articles anyway

`./vendor/bin/sail artisan processFeedArticles:start`

Launch browser to localhost


## API Requests

Can run Postman to post to `localhost/api/feeds` with the data `url => https://feeds.bbci.co.uk/news/rss.xml?edition=uk` 
Should be a form-data type

## Testing
Application tested and working on Google Chrome. Firefox doesn't allow useage of the ALT key due to it being bound to
show the browser top bar. Would recommend an alternative button to account for firefox users.

Running Windows 10 with WSL2.
