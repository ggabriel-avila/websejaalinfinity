from selenium import webdriver
import datetime
import json
import time

class bot:

    def __init__(self):
        self.json   = open('./config.json')
        self.json   = json.load(self.json)
        chrome_options = webdriver.ChromeOptions()
        chrome_options.add_experimental_option('excludeSwitches', ['enable-automation'])
        self.driver = webdriver.Chrome(self.json['archivo']['chromedriver'], options=chrome_options)
        if error := self.maximizar():
            self.error(error)
        if error := self.iniciar_sesion():
            self.error(error)
        self.logs('inicio de sesion exitoso')
        if error := self.redireccionar(self.json['url']['tracker_axie_management']):
            self.error(error)
    
    def iniciar_sesion(self):
        self.driver.get(self.json['url']['iniciar_sesion_google'])
        try:
            print(self.json['credencial']['usuario'])
            print(self.json['credencial']['usuario'])
            print(self.json['credencial']['usuario'])
            print(self.json['credencial']['usuario'])
            print(self.json['credencial']['usuario'])
            print(self.json['credencial']['usuario'])
            print(self.json['credencial']['usuario'])
            self.driver.find_element_by_xpath(self.json['xpath']['usuario']).send_keys(self.json['credencial']['usuario'])
            self.driver.find_element_by_xpath(self.json['xpath']['usuario_correcto']).click()
            return False
        except Exception as error:
            return f'enlace vacio o incorrecto (({error}))'
    
    def redireccionar(self, enlace = None):
        if enlace == None:
            return 'enlace vacio o incorrecto'
        self.driver.get(enlace)
        return False
    
    def maximizar(self):
        try:
            self.driver.maximize_window()
            return False
        except Exception as error:
            return f'error al maximizar la pantalla (({error}))'

    def error(self, mensaje = 'Error sin especificar'):
        archivo = open(self.json['archivo']['logs'], 'a', encoding = 'UTF-8')
        archivo.write(f'<error> <{datetime.datetime.now()}> {mensaje}')
        archivo.close()

    def logs(self, mensaje = ''):
        archivo = open(self.json['archivo']['logs'], 'a', encoding = 'UTF-8')
        archivo.write(f'<info> <{datetime.datetime.now()}> {mensaje}')
        archivo.close()

iniciar = bot()

# [20:59, 4/11/2021] +54 9 2216 06-2210: https://tracker.axie.management/
# [20:59, 4/11/2021] +54 9 2216 06-2210: sejaalinfinity@gmail.com
# [21:00, 4/11/2021] +54 9 2216 06-2210: ZAPATILLASpuma12345