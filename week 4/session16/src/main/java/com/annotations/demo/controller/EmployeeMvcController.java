package com.annotations.demo.controller;

import org.springframework.stereotype.Controller;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;

import com.annotations.demo.model.Employee;

@Controller
public class EmployeeMvcController {

    @Autowired
    private Employee employee;   // inject same root bean

    @GetMapping("/employee-mvc")
    public String showEmployee(Model model) {

        model.addAttribute("employee", employee);

        return "employee";
    }
}