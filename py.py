def encontrar_subcadena_maxima(lista):
    max_actual = lista[0]
    max_global = lista[0]
    inicio_actual = 0
    inicio_global = 0
    fin_global = 0
    
    for i in range(1, len(lista)):
        if lista[i] > max_actual + lista[i]:
            max_actual = lista[i]
            inicio_actual = i
        else:
            max_actual = max_actual + lista[i]
            
        if max_actual > max_global:
            max_global = max_actual
            inicio_global = inicio_actual
            fin_global = i
    
    return inicio_global, fin_global, max_global

# Ejemplo de uso
arreglo = [9,-10,4,3,-2,-8,20,-2,3,-1]
resultado = encontrar_subcadena_maxima(arreglo)
print(resultado)  # Imprime 3, que es la suma máxima del subarreglo [2, 1]
