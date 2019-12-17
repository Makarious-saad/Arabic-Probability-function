# Arabic-Probability-function
Arabic Probability function

This function was created to create more than one possibility for each word, 
such as the word (ابراهيم). 
The word probability will be created as follows 
(أبراهيم، آبراهيم، إبراهيم،ابرأهيم، ابرآهيم، ابرإهيم، أبرأهيم، آبرآهيم، إبرإهيم), 
and then the function returns the possibilities in MYSQL format for ease of use of the function and search for names within the database easily.
The letters are searched within the word in order to create the necessary possibilities and these are the letters used when searching ('ا','أ','آ','إ') ('ى','ي','ئ') ('و','ؤ') ('ه','ة')

To see how to use this PHP function to create possibilities for the word. 
below is an example that will create more than likely:

echo replace_str(array('name'),'ابراهيم');
