import pandas as pd
import nltk
from nltk.tokenize import word_tokenize
from nltk.stem import WordNetLemmatizer, PorterStemmer
from nltk.corpus import stopwords
import string

nltk.download('punkt')
nltk.download('wordnet')
nltk.download('stopwords')

def preprocess_text(text):
    # Tokenization
    tokens = word_tokenize(text)
    
    # Lowercasing
    tokens = [token.lower() for token in tokens]
    
    # Removing punctuation
    table = str.maketrans('', '', string.punctuation)
    stripped = [w.translate(table) for w in tokens]
    
    # Removing stopwords
    stop_words = set(stopwords.words('english'))
    words = [word for word in stripped if word not in stop_words]
    
    # Lemmatization
    lemmatizer = WordNetLemmatizer()
    lemmatized_words = [lemmatizer.lemmatize(word) for word in words]
    
    # Stemming
    stemmer = PorterStemmer()
    stemmed_words = [stemmer.stem(word) for word in lemmatized_words]
    
    return ' '.join(stemmed_words)

# Read the CSV file
input_file_path = "input_dataset.csv"
output_file_path = "preprocessed_dataset.csv"

data = pd.read_csv(input_file_path)

# Preprocess the text column
data['preprocessed_text'] = data['text_column'].apply(preprocess_text)

# Save the preprocessed data to a new CSV file
data.to_csv(output_file_path, index=False)
