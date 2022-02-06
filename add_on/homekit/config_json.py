import json
import MySQLdb as mdb
import configparser
import time
import collections

# Initialise the database access variables
config = configparser.ConfigParser()
config.read('/var/www/st_inc/db_config.ini')
dbhost = config.get('db', 'hostname')
dbuser = config.get('db', 'dbusername')
dbpass = config.get('db', 'dbpassword')
dbname = config.get('db', 'dbname')

# Read existing config.json in to a python dictionary
src = "/var/lib/homebridge/config.json"
with open(src, "r") as read_file:
        config = json.load(read_file)

# get zone names from the database
con = mdb.connect(dbhost, dbuser, dbpass, dbname)
cur = con.cursor()
cur.execute("SELECT * FROM zone WHERE status  = 1")
results = cur.fetchall()
row_to_index = dict((d[0], i) for i, d in enumerate(cur.description))
cur.close()
con.close()

# Fill list using template for each active zone
zonelist =[]
d = collections.OrderedDict()
d['platform'] = 'config'
d['name'] = 'Config'
d['port'] = '8581'
zonelist.append(d)

d = collections.OrderedDict()
d['platform'] = 'HttpWebHooks'
d['webhook_port'] = '51828'
d['cache_directory'] = './.node-persist/storage'
d['https'] = False

# Add switches for active zone controllers
switches = []
for row in results:
        if row[row_to_index['status']] == 1:
                sub_d = collections.OrderedDict()
                sub_d['id'] = 'switch' + str(row[row_to_index['id']])
                sub_d['name'] = row[row_to_index['name']] + ' Zone'
                sub_d['on_url'] = 'http://127.0.0.1/api/boostSet?zonename=' + row[row_to_index['name']] + '&state=1'
                sub_d['on_method'] = 'GET'
                sub_d['off_url'] = 'http://127.0.0.1/api/boostSet?zonename=' + row[row_to_index['name']] + '&state=0'
                sub_d['off_method'] = 'GET'
                switches.append(sub_d)
d['switches'] = switches

# Add sensors not associated with a zone
con = mdb.connect(dbhost, dbuser, dbpass, dbname)
cur = con.cursor()
cur.execute("SELECT sensors.id, sensors.name, sensor_type.type FROM sensors, sensor_type WHERE (sensors.sensor_type_id = sensor_type.id) AND zone_id  = 0")
results = cur.fetchall()
row_to_index = dict((d[0], i) for i, d in enumerate(cur.description))
cur.close()
con.close()

sensors = []
for row in results:
        sub_d = collections.OrderedDict()
        sub_d['id'] = 'sensor' + str(row[row_to_index['id']])
        sub_d['name'] = row[row_to_index['name']] + ' Temperature'
        sub_d['type'] = row[row_to_index['type']].lower()
        sensors.append(sub_d)
d['sensors'] = sensors
zonelist.append(d)

# Add list to dictionary
config["platforms"] = zonelist

# If the 'accessories' key exist in dictionary then delete it using del.
if "accessories" in config:
        del config['accessories']
# Add empty accessories block
config["accessories"] = []

# Write updated config.json file
with open(src, "w") as write_file:
        json.dump(config, write_file, indent = 4)

