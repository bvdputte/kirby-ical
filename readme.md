# Kirby iCal plugin

This little plugin adds downloadable .ics files that can be used to import events into your calendar (ical / google calendar / ical / ...).

⚠️ This plugin is currently a playground to test new Kirby plugin system. Do not use in production.

## Installation

Put the `ical` folder in your `site/plugins` folder.

## Features

- Kirbytag to render ical links from kirbytext-fields
- Function to render ical links via PHP

## Options

### Available parameters

You can use following named variables to generate the .ics file:

- `start`: Date when event starts. Format: `YYYY-MM-DD`
  - E.g. `2018-07-30`
- `starttime`: Time when event starts.
  - Format: `00:00:00`
  - Default: `00:00:00`
  - E.g. `08:00:00`
- `end`: Date when event ends. Format: `YYYY-MM-DD`
  - E.g. `2018-07-30`
- `endtime`: Time when event ends.
  - Format: `00:00:00`
  - Default: `59:59:59`
  - E.g. `17:30:00`
- `summary`: Optional summary.
  - E.g. `Open house`
- `description`: Optional description.
  - E.g. `Come and check out our wonderful demo's. Free drinks and food!`
- `url`: Optional event url.
  - E.g. `http://www.mywebsite.com/events/open-house-2018`
- `linktext`: The text you want to be used in the generated <a> link.
  - E.g. `Add to calendar`

### Configurable options and opionated defaults

- `routeSlug` = The slug used in the route to download the ics file.
  - Default: `ical`
- `downloadText`: The default <a> linktext.
  - Default = `Add to calendar`

Can be overridden via `option()`. E.g. `option("routeSlug", "myIcsSlug")`.

### Kirbytag example

```

(ical: start: 2018-07-30 starttime: 08:00:00 end: 2018-07-30 endtime: 17:30:00 summary: Open house linktext: +Calendar)

```

Output: `<a href="/ical/start:2018-07-30/starttime:08%3A00%3A00/end:2018-07-30/endtime:17%3A30%3A00/summary:Open+house">+Calendar</a>`

### Function example

```

$params = [
    "start" => "2018-07-30",
    "end" => "2018-07-31",
    "summary" => "Open house"
];

echo iCal::buildIcalUrl($params);

```

Output: `/ical/start:2018-07-30/end:2018-07-31/summary:Open+house`
