package com.annotations.demo.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

import com.annotations.demo.service.NotificationService;

@RestController
public class NotificationController {

    @Autowired
    @Qualifier("emailService")
    private NotificationService notificationService;

    @GetMapping("/notify")
    public String notifyUser() {
        return notificationService.sendNotification();
    }
}