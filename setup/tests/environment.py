import os
import sys

from os.path import expanduser

import psycopg2

path = sys.path[0]
path = os.path.join(path, "../")
if path not in sys.path:
	sys.path.insert(1, path)

import minimal_schema

TEST_DATABASE = "biobank_test"
"""
The database that is used as a testing environment.
"""

cursor, con = None, None

def create_testing_environment():
	"""
	Create a testing environment so that the actual database is not altered.
	"""

	con = get_connection("postgres")
	con.autocommit = True # commit all changes automatically
	cursor = con.cursor() # fetch the cursor

	"""
	Ensure that the database does not already exist.
	Create it only if it doesn't exist.
	"""
	cursor.execute("""SELECT 1 FROM pg_database WHERE datname = '%s'""" % TEST_DATABASE)
	print("Database has to be created" if not cursor.rowcount else "Database already exists")
	if (cursor.rowcount == 0):
		cursor.execute("CREATE DATABASE %s" % TEST_DATABASE)
	minimal_schema.create_schema(TEST_DATABASE)

	cursor.close()
	con.close()

def get_connection(database=TEST_DATABASE):
	# get the connection details from the .pgpass file
	home = expanduser("~")
	with open(os.path.join(home, ".pgpass"), "r") as f:
		host, port, _, username, password = f.readline().strip().split(":")
		con = psycopg2.connect(dbname=database, user=username, host=host, password=password)
	return con

def clear():
	"""
	Clear all the data from the database.
	"""

	con = get_connection()
	cursor = con.cursor() # fetch the cursor

	cursor.execute("DELETE FROM users")
	cursor.execute("DELETE FROM studies")
	con.commit()

	cursor.close()
	con.close()

if __name__ == "__main__":
	create_testing_environment()
