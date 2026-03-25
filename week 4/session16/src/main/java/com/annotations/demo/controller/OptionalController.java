package com.annotations.demo.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

import com.annotations.demo.service.ExtraService;

@RestController
public class OptionalController {

    @Autowired(required = false)   // Optional Injection
    private ExtraService extraService;

    @GetMapping("/optional")
    public String checkOptionalService() {

        if (extraService != null) {
            return extraService.extraFeature();
        }

        return "Optional service not available";
    }
}