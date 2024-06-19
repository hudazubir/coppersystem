import mysql.connector
import json

def get_database_connection():
    return mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="system_copper"
    )

def calculate_averages():
    conn = get_database_connection()
    cursor = conn.cursor()

    # Fetch stock levels for calculating average stock
    cursor.execute("SELECT totalstock FROM stock")
    stock_levels = cursor.fetchall()
    
    total_stock = sum([int(stock[0]) for stock in stock_levels])
    total_items = len(stock_levels)
    average_stock = total_stock / total_items if total_items > 0 else 0

    # Fetch prices for calculating average price
    cursor.execute("SELECT productPrice FROM product")
    prices = cursor.fetchall()
    
    total_price = sum([float(price[0]) for price in prices])
    total_products = len(prices)
    average_price = total_price / total_products if total_products > 0 else 0

    # Format average_price to 2 decimal places and add "RM" prefix
    formatted_average_price = f"RM{average_price:.2f}"

    conn.close()

    return {
        "average_stock": average_stock,
        "average_price": formatted_average_price
    }

if __name__ == "__main__":
    averages = calculate_averages()
    output = f"Average Stock: {averages['average_stock']}, \nAverage Price: {averages['average_price']}"
    print(output)
