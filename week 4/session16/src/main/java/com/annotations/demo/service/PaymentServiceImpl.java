package com.annotations.demo.service;

import org.springframework.stereotype.Service;

@Service
public class PaymentServiceImpl implements PaymentService {

    @Override
    public String makePayment() {
        return "Payment processed successfully (Constructor Injection)";
    }
}