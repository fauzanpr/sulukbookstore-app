// <reference types="cypress" />

const { before } = require("lodash");

Cypress.on('uncaught:exception', (err, runnable) => {
    // returning false here prevents Cypress from
    // failing the test
    return false
});

const visitLandingPage = function () {
    cy.visit('http://127.0.0.1:8000/');
};

const delay = function (time = 500) {
    cy.wait(time);
};

const loginAsAdmin = function () {
    visitLandingPage();
    cy.get('[data-id=admin-login]').click({force:true});
    delay();
    cy.get('#loginadmin > .modal-dialog > .modal-content > .modal-header > #exampleModalLabel').contains('Login Sebagai Admin');
    delay();
    cy.get('#loginadmin > .modal-dialog > .modal-content > .modal-body > .container > .mb-3 > #floatingInput').type('fauzanpr.06@gmail.com');
    delay();
    cy.get('#loginadmin > .modal-dialog > .modal-content > .modal-body > .container > :nth-child(2) > #floatingPassword').type('123');
    delay();
    cy.get('#loginadmin > .modal-dialog > .modal-content > .modal-footer > .btn').click();
    delay();
    cy.get(':nth-child(4) > a > .las').click();
    delay();
};

describe('User can do CRUD', () => {

    it('run artisan', () => {
        cy.exec('php artisan migrate:fresh --seed');
        cy.exec('php artisan db:seed --class=UserSeeder');
    })

    it('can do register', () => {
        visitLandingPage();
        cy.get('.main-menu > :nth-child(3) > a').click();
        cy.get('#registrasipelanggan > .modal-dialog > .modal-content > .modal-header > #exampleModalLabel').contains('Mendaftar Akun Pelanggan');
        delay();
        cy.get('#nama_pelanggan1').type('fauzanuser');
        delay();
        cy.get('#email_pelanggan1').type('user@mail.com');
        delay();
        cy.get('#password_pelanggan1').type('123');
        delay();
        cy.get('#registrasipelanggan > .modal-dialog > .modal-content > .modal-footer > .btn').click();
        delay();

        loginAsAdmin();

        // check
        cy.contains('fauzanuser').should('exist');
        cy.contains('user@mail.com').should('exist');
        delay(2000);
    });

    it('can read the new data', () => {
        loginAsAdmin();
        // check
        cy.contains('fauzanuser');
        cy.contains('user@mail.com');

        // check details
        cy.get(':nth-child(1) > :nth-child(4) > .btn-warning').click();
        delay();
        cy.contains('Detail Data Pelanggan');
        cy.contains('fauzanuser').should('exist');
        cy.contains('user@mail.com').should('exist');
        delay(2000);
        cy.get('#detailpelanggan2 > .modal-dialog > .modal-content > .modal-header > .btn-close').click();
        delay();
    });

    it('can update the data', () => {
        loginAsAdmin();
        // edit
        cy.get(':nth-child(1) > :nth-child(4) > .btn-primary').click();
        delay();
        const phone = '081236876083';
        const provinsi = 'Jawa Timur';
        const kota = 'Trenggalek';
        const kecamatan = 'Panggul';
        const alamat = 'Desa Panggul';
        cy.get('#editpelanggan2 > .modal-dialog > .modal-content > .modal-body > [style="max-width: 700px;"] > .g-0 > .col-md-8 > .card-body > :nth-child(3) > .col-sm-7 > #judulf').clear().type(`${phone}`);
        delay();
        cy.get('#editpelanggan2 > .modal-dialog > .modal-content > .modal-body > [style="max-width: 700px;"] > .g-0 > .col-md-8 > .card-body > :nth-child(5) > .col-sm-7 > #provinsif').clear().type(`${provinsi}`);
        delay();
        cy.get('#editpelanggan2 > .modal-dialog > .modal-content > .modal-body > [style="max-width: 700px;"] > .g-0 > .col-md-8 > .card-body > :nth-child(6) > .col-sm-7 > #kotaf').type(`${kota}`);
        delay();
        cy.get('#editpelanggan2 > .modal-dialog > .modal-content > .modal-body > [style="max-width: 700px;"] > .g-0 > .col-md-8 > .card-body > :nth-child(7) > .col-sm-7 > #kecamatanf').type(`${kecamatan}`);
        delay();
        cy.get('#editpelanggan2 > .modal-dialog > .modal-content > .modal-body > [style="max-width: 700px;"] > .g-0 > .col-md-8 > .card-body > :nth-child(8) > .col-sm-7 > #alamatf').type(`${alamat}`);
        delay();
        cy.get('#ISBNf').clear().type('fauzan aja');
        delay();
        cy.get('#editpelanggan2 > .modal-dialog > .modal-content > .modal-footer > .btn').click();
        delay();

        // check the update
        cy.get(':nth-child(1) > :nth-child(4) > .btn-warning').click();
        delay();
        cy.get(':nth-child(1) > .col-sm-8 > p').should('have.text', ': fauzan aja');
        cy.get(':nth-child(2) > .col-sm-8 > p').should('have.text', `: ${phone}`);
        cy.get(':nth-child(4) > .col-sm-8 > p').should('have.text', `: ${provinsi}`);
        cy.get(':nth-child(5) > .col-sm-8 > p').should('have.text', `: ${kota}`);
        cy.get(':nth-child(6) > .col-sm-8 > p').should('have.text', `: ${kecamatan}`);
        cy.get(':nth-child(7) > .col-sm-8 > p').should('have.text', `: ${alamat}`);
        delay(2000);
        cy.get('#detailpelanggan2 > .modal-dialog > .modal-content > .modal-header > .btn-close').click();
    });

    it('can delete the data', () => {
        loginAsAdmin();
        // delete
        cy.get('form > .btn > .las').click();

        // check is deleted?
        cy.contains('p', 'fauzan aja').should('not.exist');
        delay(2000);
    });

});
