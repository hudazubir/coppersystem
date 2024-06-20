 total_price = sum([float(price[0]) for price in prices])
    total_products = len(prices)
    average_price = total_price / total_products if total_products > 0 else 0