// <reference types="cypress" />

const itCanVisitLoginPage = function () {
    cy.visit('http://127.0.0.1:8000/');
    cy.get('#loginpelanggan > .modal-dialog > .modal-content > .modal-header > #exampleModalLabel').should('have.text', 'Login Sebagai Pelanggan');
    cy.get('#loginpelanggan > .modal-dialog > .modal-content > .modal-footer > .btn').should('have.text', 'Login');
    cy.get('#loginpelanggan').contains('Email address');
    cy.get('#loginpelanggan').contains('Password');
};

const visitHomepage = function () {
    cy.visit('http://127.0.0.1:8000/');
}

const toLoginPelangganForm = function () {
    cy.get('#loginpelanggan > .modal-dialog > .modal-content > .modal-body > .container > .mb-3 > #floatingInput').type('fauzanpr.06@gmail.com', {force: true});
    cy.get('#loginpelanggan > .modal-dialog > .modal-content > .modal-body > .container > :nth-child(2) > #floatingPassword').type('123');
    cy.get('#loginpelanggan > .modal-dialog > .modal-content > .modal-footer > .btn').click({force: true});
}

describe('User can login', () => {
    it('User can visit login page', () => {
        itCanVisitLoginPage();
    });

    it('User can login and logout', () => {
        visitHomepage();
        cy.get('.main-menu > :nth-child(2) > [href="#"]').invoke('show');
        cy.contains('Pelanggan').click({force: true});
        toLoginPelangganForm();
        cy.wait(1000);
        cy.get('#dropdownMenuLink > .zmdi').click();
        cy.get('.dropdown-menu > :nth-child(1) > .dropdown-item').click();
        cy.get('#editprofil > .modal-dialog > .modal-content > .modal-header > #exampleModalLabel').should('have.text', 'Edit Profile');
        cy.get(':nth-child(2) > .form-label').should('have.text', 'Nama');
        cy.wait(1000);
        cy.get('#editprofil > .modal-dialog > .modal-content > .modal-header > .btn-close').click();
        cy.get('#dropdownMenuLink > .zmdi').click();
        cy.wait(1000);
        cy.get('form > .dropdown-item').click();
    });
});
