# Change Log
All notable changes to this project will be documented in this file.

## [0.0.1] Initial Release

This is our initial release of the plugin

## [0.0.2] Initial Fixes - 2022-07-02

### Added
- JS Attribute checking, Logs errors to Console

### Fixes
- Fixed Looping not working of FireFox

## [0.0.3] Initial Fixes - 2022-07-03

### Added
- Touch events 
- Event on frame change "wpg/Scroll_Sequence/frame"

#### "wpg/Scroll_Sequence/frame"
Every time the frame changes this event is dispatched on window.
The Container ID and teh current frame are in ethe event detail

eg.
<pre>
window.addEventListener('wpg/Scroll_Sequence/frame', e => { 
    const {id, frame} = e.detail;
    console.log('id': id);
    console.log('frame': frame);
})
</pre>

### Fixes
- Renamed all incorrect namings of 'wpe' to 'wpg'
- Renamed incorrect naming of 'toolbar' to 'tipbar'


## [0.0.4] Added Features - 2022-07-05

### Added
- Site Settings - Branding Icon
