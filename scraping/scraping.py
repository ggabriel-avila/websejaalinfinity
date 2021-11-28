import pyautogui
import time

class bot:
    '''
        Extraccion de datos para sejaalinfinity
    '''
    def __init__(self):
        pyautogui.PAUSE = 0
        self.cambiar_seccion()
        self.abrir_consola()
        contador = 0
        while(True):
            contador = contador + 1
            self.iniciar_bucle()
            time.sleep(10)
            if contador == 10:
                time.sleep(3)
                self.abrir_consola()
                time.sleep(3)
                self.abrir_consola()
                time.sleep(3)
                contador = 0


    def cambiar_seccion(self):
        pyautogui.hotkey('altleft', 'tab')
    
    def iniciar_bucle(self):
        time.sleep(1)
        script = open('./scripts.js', 'r', encoding='UTF-8').read()
        pyautogui.typewrite(script, 0.07)
        pyautogui.press('enter')
        time.sleep(10)

        self.limpiar_consola()
        self.refrescar_pagina()

    def abrir_consola(self):
        time.sleep(1)
        pyautogui.hotkey('ctrlleft', 'shift', 'i')
        time.sleep(1)

    def limpiar_consola(self):
        pyautogui.typewrite('clear()')
        pyautogui.press('enter')
    
    def refrescar_pagina(self):
        pyautogui.press('f5')

iniciar = bot()

#web.sejaal@gmail.com
#123456789159753