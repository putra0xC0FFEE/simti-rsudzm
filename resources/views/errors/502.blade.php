@include('errors.error', [ 
  'title' => '502 | Bad Gateway',
  'lines' => [
    "Error! 502",
    "Bad Gateway",
    "The server received an invalid response from upstream.",
    "Please try again later.",
    "Press [Enter] key to return to dashboard..."
  ]
])
