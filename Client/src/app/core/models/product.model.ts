export class Product {
    id: number;
    name: string;
    price: number;
    price_currency: string;
    price_formatted: string;
    description: string;

    static fromJson(data: any) {
        let product = new Product;
        product.id = data.id;
        product.name = data.name;
        product.price = data.price;
        product.price_currency = data.price_currency;
        product.price_formatted = data.price_formatted;
        product.description = data.description;
        return product;
    }
}