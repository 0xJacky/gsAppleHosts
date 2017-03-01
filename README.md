# gsAppleHost

The aim of this open source project is offering a gs.apple.com proxy working in a server such as a Rasbperry PI.

## Installation

### Server
Extract the project in the /srv folder of your server and review & integrate apache config in apache/ subfolder.

### Clients
Add 
'''
server_ip	gs.apple.com
'''
 in the /etc/hosts file of your clients.

## Usage

Admin can be accessed at http://gs.apple.com/admin after completing setup.
The source code is quite easy and commented. You may personalize it as you want.
