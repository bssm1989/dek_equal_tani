import re

def remove_comments(sql_content):
    # Remove multi-line comments (/* ... */)
    sql_content = re.sub(r'/\*.*?\*/', '', sql_content, flags=re.DOTALL)
    
    # Remove single-line comments (-- ...)
    sql_content = re.sub(r'--.*', '', sql_content)
    
    return sql_content.strip()

def split_sql_file(filename, max_chars=4096):
    with open(filename, 'r', encoding='utf-8') as sql_file:
        sql_content = sql_file.read()

    sql_content = remove_comments(sql_content)
    words = sql_content.split()
    chunks = []
    current_chunk = []

    for word in words:
        if sum(len(word) for word in current_chunk) + len(current_chunk) + len(word) <= max_chars:
            current_chunk.append(word)
        else:
            chunks.append(' '.join(current_chunk))
            current_chunk = [word]

    if current_chunk:
        chunks.append(' '.join(current_chunk))
    
    return chunks

# Example usage:
file_path = 'dek_equal_tani.sql'
split_chunks = split_sql_file(file_path)

for i, chunk in enumerate(split_chunks):
    print(f"Chunk {i + 1}:")
    print(chunk)
    print("---")
