package com.annotations.demo.service;

import org.springframework.stereotype.Component;

@Component   // This makes the bean available
public class ExtraService {

    public String extraFeature() {
        return "Optional service is available";
    }
}