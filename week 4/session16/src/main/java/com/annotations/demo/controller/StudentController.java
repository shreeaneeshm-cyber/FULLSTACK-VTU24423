package com.annotations.demo.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

import com.annotations.demo.service.StudentService;

@RestController
public class StudentController {

    @Autowired
    private StudentService studentService;   // Field Injection

    @GetMapping("/student")
    public String student() {
        return studentService.getMessage();
    }
}
