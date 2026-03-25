package com.annotations.demo.service;

import org.springframework.stereotype.Service;

@Service
public class StudentService {

    public String getMessage() {
        return "Student Service called using @Autowired";
    }
}