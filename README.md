
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

## Launching Application

run in terminal: `./vendor/bin/sail up`

## API Requests

Can run Postman to post to `localhost/api/feeds` with the data `url => https://feeds.bbci.co.uk/news/rss.xml?edition=uk` 
Should be a form-data type
