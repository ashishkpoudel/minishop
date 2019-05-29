import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';

import { ProductService } from 'src/app/core';
import { CheckoutService } from 'src/app/core';
import { Product } from 'src/app/core';

@Component({
  selector: 'app-product',
  templateUrl: './product.component.html',
  styleUrls: ['./product.component.css']
})
export class ProductComponent implements OnInit {

  product: Product = new Product();
  product_form: FormGroup;

  success_message: string;

  constructor (
    private product_service: ProductService,
    private checkout_service: CheckoutService,
    private form_builder: FormBuilder,
    private route: ActivatedRoute) { }

  ngOnInit() {
    this.product_form = this.form_builder.group({
      product_id: [null, Validators.required],
      quantity: [null, Validators.required],
      payment_method: [null, Validators.required],
    });

    this.route.params.subscribe (
      data => {
        this.product_service.getProduct(data['id']).subscribe (
          data => {
            this.product = data;
            this.product_form.patchValue({product_id: this.product.id});
          }
        );
      }
    );
  }

  onProceed()
  {
    // Using form data instead of json payload

    // let order = {
    //   product_id: this.product_form.get('product_id').value,
    //   quantity: this.product_form.get('quantity').value,
    //   payment_method: this.product_form.get('payment_method').value
    // };

    let fd = new FormData();
    fd.append('product_id', this.product_form.get('product_id').value);
    fd.append('quantity', this.product_form.get('quantity').value);
    fd.append('payment_method', this.product_form.get('payment_method').value);


    this.checkout_service.create(fd).subscribe (
      data => {
        this.success_message = data.message;
      },
      error => {
        if (error.status === 400) {
          alert(error.error.message);
        }
      }
    );
  }

}
