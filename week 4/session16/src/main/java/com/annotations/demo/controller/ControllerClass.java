package com.annotations.demo.controller;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class ControllerClass {

    @GetMapping("/")
    public String hello() {
        return "Spring Boot Web Application Running";
    }
}

