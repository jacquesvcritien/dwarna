"""
The email partials contain components of an email.
"""

import os
import sys

path = sys.path[0]
path = os.path.join(path, "../")
if path not in sys.path:
	sys.path.insert(1, path)

from config.routes import base_url

def header():
	"""
	Get the header of the email.

	:return: A string containing the header of the email.
	:rtype: str
	"""

	return f"""<html>
		<head></head>
		<body>
			<img src="{base_url}/assets/dwarna-logo.png" style='max-width: 62.8%%; margin: 0 auto'>"""

def footer():
	"""
	Get the footer of the email.

	:return: A string containing the footer of the email.
	:rtype: str
	"""

	return f"""</body>
	</html>"""
